/**
 * Hotel tabs: tab switching + animated hotel card grid
 * Replace HOTEL_DATA to update listings; keys must match data-hotel-tab values.
 */
(function () {
  'use strict';

  var reduceMotion =
    typeof window.matchMedia === 'function' &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var FADE_MS = reduceMotion ? 0 : 420;

  /** @type {Record<string, Array<{title: string, location: string, stars: number, text: string, image: string, layout: 'text-first'|'media-first'}>>} */
  var HOTEL_DATA = window.HOTEL_DATA || {
    all: [
      { title: 'Ocean Eden Bay', location: 'Montego Bay | Jamaica', stars: 5, text: 'Beachfront luxury with curated dining and family-friendly pools.', image: 'images/profile1.jpg', layout: 'text-first' },
      { title: 'Ocean Coral & Turquesa', location: 'Riviera Maya | Mexico', stars: 5, text: 'Spacious suites, vibrant experiences nearby, and endless ocean views.', image: 'images/profile2.jpg', layout: 'media-first' },
      { title: 'Ocean Maya Royale', location: 'Playa del Carmen | Mexico', stars: 5, text: 'Refined atmosphere with quiet pools and attentive concierge service.', image: 'images/profile3.jpg', layout: 'text-first' },
    ],
    adults: [
      { title: 'Azure Cove Retreat', location: 'Punta Cana | Dominican Republic', stars: 5, text: 'Adults-only serenity, rooftop lounges, and spa rituals at sunset.', image: 'images/profile2.jpg', layout: 'media-first' },
      { title: 'Velvet Shore', location: 'Tenerife | Spain', stars: 4, text: 'Cliffside suites, infinity pools, and curated wine evenings.', image: 'images/profile3.jpg', layout: 'text-first' },
      { title: 'Luna Bay Club', location: 'Montego Bay | Jamaica', stars: 5, text: 'Quiet beaches, private cabanas, and chef-led tasting menus.', image: 'images/profile1.jpg', layout: 'media-first' },
    ],
    spa: [
      { title: 'Despacio Spa Haven', location: 'Riviera Maya | Mexico', stars: 5, text: 'Thermal circuits, hydrotherapy, and bespoke wellness journeys.', image: 'images/profile3.jpg', layout: 'text-first' },
      { title: 'Garden Springs', location: 'Gran Canaria | Spain', stars: 5, text: 'Outdoor treatment suites nestled in tropical gardens.', image: 'images/profile1.jpg', layout: 'media-first' },
      { title: 'Tide & Stone Spa', location: 'Punta Cana | Dominican Republic', stars: 4, text: 'Mindful movement studios and marine-inspired therapies.', image: 'images/profile2.jpg', layout: 'text-first' },
    ],
    wedding: [
      { title: 'Ceremony Bay Resort', location: 'Montego Bay | Jamaica', stars: 5, text: 'Oceanfront vows, ballroom receptions, and dedicated planners.', image: 'images/profile1.jpg', layout: 'media-first' },
      { title: 'Palm Court Estates', location: 'Riviera Maya | Mexico', stars: 5, text: 'Garden gazebos, live music terraces, and guest room blocks.', image: 'images/profile2.jpg', layout: 'text-first' },
      { title: 'Sunset Pier Hotel', location: 'Tenerife | Spain', stars: 5, text: 'Cliff-top chapels and sunset photo sessions over the Atlantic.', image: 'images/profile3.jpg', layout: 'media-first' },
    ],
  };

  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function starsMarkup(n) {
    var filled = Math.min(5, Math.max(0, Math.round(n)));
    var chars = '';
    for (var i = 0; i < 5; i++) chars += i < filled ? '★' : '☆';
    return '<span class="hotel-card__stars" aria-label="' + filled + ' out of 5 stars">' + chars + '</span>';
  }

  function buildCard(h) {
    var body =
      '<div class="hotel-card__body">' +
      '<h3 class="hotel-card__title">' + escapeHtml(h.title) + '</h3>' +
      '<div class="hotel-card__meta">' +
      starsMarkup(h.stars) +
      '<span class="hotel-card__location">' + escapeHtml(h.location) + '</span>' +
      '</div>' +
      '<p class="hotel-card__desc">' + escapeHtml(h.text) + '</p>' +
      '<a href="#" class="hotel-card__cta">View hotel <span class="hotel-card__cta-arrow" aria-hidden="true">→</span></a>' +
      '</div>';

    var media =
      '<div class="hotel-card__media">' +
      '<img class="hotel-card__img" src="' + escapeHtml(h.image) + '" alt="" loading="lazy" width="640" height="400">' +
      '</div>';

    var isMediaFirst = h.layout === 'media-first';
    var inner = isMediaFirst ? media + body : body + media;
    return (
      '<article class="hotel-card ' +
      (isMediaFirst ? 'hotel-card--media-first' : 'hotel-card--text-first') +
      '">' +
      inner +
      '</article>'
    );
  }

  function buildGrid(tabKey) {
    var defaultKey = Object.keys(HOTEL_DATA)[0];
    var rows = HOTEL_DATA[tabKey] || HOTEL_DATA[defaultKey] || [];
    return '<div class="hotel-tabs__grid">' + rows.map(buildCard).join('') + '</div>';
  }

  function initHotelTabs() {
    var root = document.querySelector('[data-hotel-tabs-root]');
    var tabs = document.querySelectorAll('[data-hotel-tab]');
    if (!root || !tabs.length) return;

    var activeKey = tabs[0].getAttribute('data-hotel-tab');
    var switching = false;

    var surface = document.createElement('div');
    surface.className = 'hotel-tabs__surface';
    surface.innerHTML = buildGrid(activeKey);
    root.appendChild(surface);

    function setActiveTab(key) {
      tabs.forEach(function (tab) {
        var match = tab.getAttribute('data-hotel-tab') === key;
        tab.classList.toggle('hotel-tabs__tab--active', match);
        tab.setAttribute('aria-selected', match ? 'true' : 'false');
        tab.tabIndex = match ? 0 : -1;
        if (match) {
          var id = tab.getAttribute('id');
          if (id) root.setAttribute('aria-labelledby', id);
        }
      });
    }

    /** Crossfade + light vertical motion: exit class, swap HTML, enter class */
    function switchTo(key) {
      if (key === activeKey || switching) return;
      switching = true;
      activeKey = key;
      setActiveTab(key);

      surface.classList.add('hotel-tabs__surface--exit');

      window.setTimeout(function () {
        surface.innerHTML = buildGrid(key);
        surface.classList.remove('hotel-tabs__surface--exit');
        surface.classList.add('hotel-tabs__surface--enter');
        window.requestAnimationFrame(function () {
          window.requestAnimationFrame(function () {
            surface.classList.remove('hotel-tabs__surface--enter');
            switching = false;
          });
        });
      }, FADE_MS);
    }

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        switchTo(tab.getAttribute('data-hotel-tab') || 'all');
      });
    });

    var tablist = tabs[0] && tabs[0].parentElement;
    if (tablist) {
      tablist.addEventListener('keydown', function (e) {
        var keys = ['ArrowLeft', 'ArrowRight', 'Home', 'End'];
        if (keys.indexOf(e.key) === -1) return;
        var list = Array.prototype.slice.call(tabs);
        var i = list.indexOf(document.activeElement);
        if (i === -1) return;
        e.preventDefault();
        var next = i;
        if (e.key === 'ArrowLeft') next = (i - 1 + list.length) % list.length;
        if (e.key === 'ArrowRight') next = (i + 1) % list.length;
        if (e.key === 'Home') next = 0;
        if (e.key === 'End') next = list.length - 1;
        list[next].focus();
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHotelTabs);
  } else {
    initHotelTabs();
  }
})();
