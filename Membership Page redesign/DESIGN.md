---
name: Heritage Grace
colors:
  surface: '#faf9fc'
  surface-dim: '#dbd9dd'
  surface-bright: '#faf9fc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f4f3f6'
  surface-container: '#efedf0'
  surface-container-high: '#e9e7eb'
  surface-container-highest: '#e3e2e5'
  on-surface: '#1a1c1e'
  on-surface-variant: '#43474e'
  inverse-surface: '#2f3033'
  inverse-on-surface: '#f2f0f3'
  outline: '#74777f'
  outline-variant: '#c4c6cf'
  surface-tint: '#476083'
  primary: '#000613'
  on-primary: '#ffffff'
  primary-container: '#001f3f'
  on-primary-container: '#6f88ad'
  inverse-primary: '#afc8f0'
  secondary: '#775a19'
  on-secondary: '#ffffff'
  secondary-container: '#fed488'
  on-secondary-container: '#785a1a'
  tertiary: '#050605'
  on-tertiary: '#ffffff'
  tertiary-container: '#1e1f1d'
  on-tertiary-container: '#878683'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d4e3ff'
  primary-fixed-dim: '#afc8f0'
  on-primary-fixed: '#001c3a'
  on-primary-fixed-variant: '#2f486a'
  secondary-fixed: '#ffdea5'
  secondary-fixed-dim: '#e9c176'
  on-secondary-fixed: '#261900'
  on-secondary-fixed-variant: '#5d4201'
  tertiary-fixed: '#e4e2de'
  tertiary-fixed-dim: '#c8c6c3'
  on-tertiary-fixed: '#1b1c1a'
  on-tertiary-fixed-variant: '#474744'
  background: '#faf9fc'
  on-background: '#1a1c1e'
  surface-variant: '#e3e2e5'
  cream-base: '#FDFBF7'
  deep-navy: '#001F3F'
  accent-gold: '#C5A059'
  slate-gray: '#4A5568'
typography:
  display-lg:
    fontFamily: Playfair Display
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Playfair Display
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Playfair Display
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
  headline-sm:
    fontFamily: Playfair Display
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-caps:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: '1'
    letterSpacing: 0.1em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 8px
  container-max: 1280px
  gutter: 24px
  margin-desktop: 64px
  margin-mobile: 20px
  section-gap: 120px
---

## Brand & Style

This design system embodies a **Traditional Hospitality** aesthetic, prioritizing timeless elegance, reliability, and a premium guest experience. It is designed for high-end hospitality services that value heritage and personal connection.

The visual style is a curated mix of **Minimalism** and **Corporate Modernity**, utilizing heavy whitespace to evoke a sense of calm and luxury. By pairing high-contrast navy and cream with structured layouts, the system communicates an authoritative yet welcoming presence. Decorative elements are used sparingly, relying on high-quality destination imagery and refined typography to tell the story of "Dream Hospitality."

## Colors

The palette is rooted in a high-contrast relationship between **Deep Navy** and **Cream**. 

- **Primary (Deep Navy):** Used for navigation bars, primary headings, and high-emphasis action buttons. It represents stability and professional excellence.
- **Secondary (Accent Gold):** Used sparingly for highlighting key information, such as pricing, special offers, or decorative borders, to denote premium value.
- **Tertiary (Cream/Off-White):** Serves as the primary background color for all surfaces, offering a warmer, more sophisticated alternative to pure white.
- **Neutral:** A range of grays derived from the navy hue are used for body text and metadata to maintain visual cohesion.

## Typography

The typography system relies on the interplay between a sophisticated serif and a functional sans-serif.

**Playfair Display** is used for all headlines and display roles. Its high contrast and elegant curves evoke a literary and editorial feel, reinforcing the brand's premium positioning.

**Inter** is utilized for body copy, labels, and UI elements. Its clean, neutral character ensures maximum legibility across all digital interfaces, balancing the ornamental nature of the headline font.

For navigation and metadata, we utilize `label-caps` to provide a structured, architectural feel to the information hierarchy.

## Layout & Spacing

This design system employs a **Fixed Grid** layout for desktop, centered within the viewport to maintain a focused, editorial appearance. 

- **Grid:** A 12-column grid system with 24px gutters.
- **Rhythm:** Spacing follows an 8px incremental scale. Generous vertical padding (Section Gaps) of 120px is used between major content blocks to create a feeling of "luxury and air."
- **Adaptation:** On mobile devices, margins shrink to 20px, and grid columns collapse to a single vertical stack. Text alignment typically shifts from centered (desktop) to left-aligned (mobile) for better readability.

## Elevation & Depth

Hierarchy is conveyed primarily through **Tonal Layers** and **Subtle Outlines** rather than aggressive shadows.

1.  **Base Layer:** The Cream (`#FDFBF7`) surface serves as the foundation.
2.  **Raised Surfaces:** Content cards use a 1px solid border in a very light navy tint or gold, with an extremely soft, diffused ambient shadow (4% opacity) to provide a "lifted" effect.
3.  **Depth via Imagery:** High-quality photography is used to create depth. Text overlays on images must use a 30-40% navy gradient overlay to ensure the white serif typography remains legible and high-contrast.

## Shapes

The shape language is conservative and structured. We utilize **Soft (0.25rem)** corners to take the edge off a purely corporate look without veering into "bubbly" or overly casual territory.

- **Standard Elements:** Buttons, input fields, and tags use the base `rounded` (4px) setting.
- **Large Containers:** Hero images and card layouts use `rounded-lg` (8px) to soften the large surface areas.
- **Exceptions:** Decorative dividers and hairline borders remain sharp (0px) to maintain the traditional "lined" aesthetic of classical stationery.

## Components

### Buttons
Primary buttons are solid Navy with white text, featuring a 4px border radius. Secondary buttons use a ghost style: a 1.5px Gold border with Navy or Gold text, emphasizing a refined, non-aggressive call to action.

### Input Fields
Fields utilize a Cream background slightly darker than the page base, with a 1px Navy bottom-border or full border. Focus states are indicated by a subtle Gold border glow. Labels are always positioned above the field in `label-caps` typography.

### Cards
Cards are the primary vehicle for destinations and member stories. They feature a generous 32px internal padding, a 1px subtle border, and high-quality imagery. The title of the card should always be in Playfair Display.

### Iconography
Icons must be "Line" style—thin, elegant, and non-filled. They should be rendered in Gold or Navy to match the brand palette.

### Decorative Elements
Use subtle "PNG-style" overlays, such as light paper textures or very faint crest/logo watermarks in the background of sections, to add a tactile, high-end layered look to the digital experience.