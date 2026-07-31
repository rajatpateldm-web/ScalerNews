---
name: Chronicle Authority
colors:
  surface: '#f8f9fa'
  surface-dim: '#d9dadb'
  surface-bright: '#f8f9fa'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f4f5'
  surface-container: '#edeeef'
  surface-container-high: '#e7e8e9'
  surface-container-highest: '#e1e3e4'
  on-surface: '#191c1d'
  on-surface-variant: '#44474c'
  inverse-surface: '#2e3132'
  inverse-on-surface: '#f0f1f2'
  outline: '#74777d'
  outline-variant: '#c4c6cd'
  surface-tint: '#4f6073'
  primary: '#041627'
  on-primary: '#ffffff'
  primary-container: '#1a2b3c'
  on-primary-container: '#8192a7'
  inverse-primary: '#b7c8de'
  secondary: '#b6171e'
  on-secondary: '#ffffff'
  secondary-container: '#da3433'
  on-secondary-container: '#fffbff'
  tertiary: '#0a1526'
  on-tertiary: '#ffffff'
  tertiary-container: '#1f2a3b'
  on-tertiary-container: '#8691a6'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d2e4fb'
  primary-fixed-dim: '#b7c8de'
  on-primary-fixed: '#0b1d2d'
  on-primary-fixed-variant: '#38485a'
  secondary-fixed: '#ffdad6'
  secondary-fixed-dim: '#ffb3ac'
  on-secondary-fixed: '#410003'
  on-secondary-fixed-variant: '#930010'
  tertiary-fixed: '#d8e3fa'
  tertiary-fixed-dim: '#bcc7dd'
  on-tertiary-fixed: '#111c2c'
  on-tertiary-fixed-variant: '#3c475a'
  background: '#f8f9fa'
  on-background: '#191c1d'
  surface-variant: '#e1e3e4'
typography:
  display-xl:
    fontFamily: Bodoni Moda
    fontSize: 64px
    fontWeight: '800'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Bodoni Moda
    fontSize: 40px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-lg-mobile:
    fontFamily: Bodoni Moda
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Bodoni Moda
    fontSize: 28px
    fontWeight: '700'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Libre Franklin
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Libre Franklin
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.5'
  label-caps:
    fontFamily: Archivo Narrow
    fontSize: 12px
    fontWeight: '700'
    lineHeight: '1.0'
    letterSpacing: 0.05em
spacing:
  container-max: 1280px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 32px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
  stack-xl: 64px
---

## Brand & Style

The brand personality is authoritative, objective, and urgent. It is designed for a sophisticated audience that values editorial integrity and rapid information delivery. The design system adopts a **Modern Editorial** style—a hybrid of traditional broadsheet aesthetics and high-performance digital interfaces. 

The visual language emphasizes clarity and speed. It utilizes a structured grid, high-contrast typography, and purposeful whitespace to reduce cognitive load while maintaining a sense of journalistic gravity. The emotional response should be one of immediate trust and intellectual stimulation.

## Colors

The palette is anchored by **Deep Navy (#1a2b3c)**, which provides the foundational "ink" of the system, used for headers, primary navigation, and high-level structural elements to establish authority. **Energetic Crimson (#d32f2f)** is reserved strictly for high-priority signals: breaking news flags, live updates, and urgent alerts.

The background uses **Clean White/Light Gray (#f8f9fa)** to provide a soft canvas that reduces eye strain during long-form reading. Accents and metadata utilize a slate-toned tertiary gray to maintain a clear hierarchy without competing with the primary content.

## Typography

The typography system is built on a high-contrast pairing designed for legibility and impact. **Bodoni Moda** serves as the headline face, delivering a traditional editorial feel with modern digital sharpness. For body text, **Libre Franklin** provides a neutral, highly legible sans-serif experience that remains clear even in dense information environments.

**Archivo Narrow** is utilized for metadata, categories, and utility labels, where space efficiency and clear distinction from the narrative text are required. Vertical rhythm is strictly enforced with a 1.5x to 1.6x line-height for body copy to ensure optimal reading flow.

## Layout & Spacing

This design system uses a **12-column fluid grid** for desktop and a **4-column grid** for mobile. The layout philosophy is "Mobile-First, Content-Centric." 

On desktop, the central column is often reserved for the main article body (spanning 8 columns), with sidebars (4 columns) used for "Related Stories" or "Live Feed" widgets. Spacing follows a strict base-8 scale to maintain a rhythmic vertical flow. Large "hero" sections for lead stories should utilize the full container width with generous top and bottom padding (stack-xl) to create a sense of importance.

## Elevation & Depth

To maintain a credible, paper-like feel, this design system avoids heavy shadows and complex gradients. Depth is achieved through **Low-contrast outlines** and **Tonal layers**.

- **Surface 0:** The main background (#f8f9fa).
- **Surface 1:** Pure white (#ffffff) containers for cards or specific article sections, defined by a 1px border in a light muted navy (#e2e8f0).
- **Separators:** 1px or 2px solid lines are used to divide sections, mimicking the layout of traditional newspapers. 

Interactive elements like buttons or hovered cards should not lift off the page with shadows; instead, they should respond with subtle background color shifts or border weight increases.

## Shapes

The shape language is **Sharp (0)**. Square corners are used across all UI elements—including buttons, input fields, image containers, and cards—to reinforce the professional, institutional, and "unfiltered" nature of the news. This geometric rigidity provides a disciplined framework that contrasts with the fluid, organic nature of photography and editorial illustrations.

## Components

### Buttons
Primary buttons are solid Deep Navy (#1a2b3c) with white text, utilizing all-caps Archivo Narrow for a functional, "action-oriented" look. Secondary buttons use a 2px Deep Navy border with no fill.

### Cards
Article cards are flat with 1px borders. They prioritize the headline (Bodoni Moda) and a timestamp label. Hover states are indicated by a slight tinting of the background to a very light gray.

### Chips & Tags
Used for categories (e.g., "POLITICS", "TECH"). These use Archivo Narrow, bold, uppercase, with a 2px bottom border in the primary color rather than a pill-shaped container.

### Input Fields
Strictly rectangular with a 1px Navy border. Focused states use a 2px border. Labels are placed above the field in a bold, small sans-serif.

### Breaking News Ticker
A full-width Crimson (#d32f2f) bar at the top of the viewport or header. Text is white, Archivo Narrow, bold, and scrolls horizontally or fades between headlines.

### Data Tables
Used for financial or sports data. These use a clean, minimal layout with horizontal-only separators and "zebra-striping" using the neutral background color.