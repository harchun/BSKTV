# BSKTV 2.0 Architecture Plan

## 01. Product goal

BSKTV is a store discovery and information platform for Taiwan business KTV / 酒店 listings.

Primary user journey:

Find → Evaluate → Contact

## 02. Information architecture

- Home
- Store directory
- Search
- City taxonomy
- Type taxonomy
- Store detail
- Favorites
- Utility / system states

## 03. Store detail information hierarchy

1. Store identity
2. Operating status
3. City / type
4. Main image
5. Article introduction
6. Store information
7. Fee information
8. Gallery
9. LINE contact

## 04. Design system

### Tokens

- Background
- Surface
- Border
- Text
- Muted text
- Gold accent
- Success
- Warning
- Error
- Spacing scale
- Radius scale
- Shadow scale

### Components

- Header
- Mobile navigation
- Hero
- Search box
- Store card
- Store grid
- Filter bar
- Badge
- Button
- Information row
- Gallery
- Empty state
- Loading state
- Error state
- Pagination / Load more
- Footer

## 05. State model

Every asynchronous interface must support:

Idle → Loading → Success / Empty / Error

No feature should depend on a blank DOM state to communicate failure.

## 06. Store validity

A public store is valid when:

- post type is post
- post status is publish
- bsktv_status is empty or active

The same rule must be reused by:

- homepage counts
- homepage featured
- homepage latest
- search
- favorites
- related stores
- store cards
- tracking

## 07. Data ownership

Admin manages structured store data.

Editor content remains free-form and is used for detailed descriptions and manually maintained consumption information.

## 08. Navigation

Desktop navigation is persistent.

Mobile navigation is a controlled disclosure with:

- open state
- close state
- outside click
- Escape
- focus handling

## 09. Progressive loading

Homepage latest listings may auto-load.

Directory/search results should retain an explicit load-more or pagination affordance so users can understand result boundaries.

## 10. Accessibility

- Semantic headings
- Focus-visible states
- aria labels where needed
- Keyboard support
- Reduced motion
- Touch-friendly controls
- Meaningful image alt text

## 11. Performance

- Responsive WordPress image sizes
- Lazy load below-the-fold images
- High priority only for primary hero media
- Avoid unnecessary frontend requests
- Avoid repeated database reads inside loops
- Version assets for cache invalidation

## 12. Security

- sanitize input
- escape output
- verify nonce on AJAX
- check post permissions on admin actions
- validate post IDs and URLs
- do not trust browser-provided favorite / tracking data

## 13. SEO

- unique page titles
- meta description
- canonical
- Open Graph
- valid breadcrumb data
- business structured data only where its type and properties accurately describe the page
- no duplicate SEO output when a recognized SEO plugin is active

## 14. Quality gates

Before production:

- PHP syntax / CI lint
- JavaScript syntax review
- CSS selector audit
- desktop layout review
- 375 / 390 / 430 px mobile review
- archive pagination review
- search empty/error review
- store-without-image review
- store-without-fee review
- store-without-LINE review
- closed / pending store review
- cache busting review
