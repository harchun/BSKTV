# BSKTV Standalone Web

BSKTV is being rebuilt as a product platform instead of a WordPress theme.

## Product layers

- Discovery: search, city, category, venue directory
- Venue: brand page, gallery, information, status, contact and favorite
- NOW: recommendations, reviews, updates and community content
- Account: favorites, contributions and profile
- Business: venue claiming, data management, campaigns and analytics

## Stack

- Next.js 15 App Router
- React 19
- TypeScript
- PostgreSQL as the target system of record
- Object storage for venue media
- API-first domain model

## Development order

1. Product shell and discovery UX
2. Venue data model and PostgreSQL
3. Search and filtering
4. Venue detail and media
5. Favorites and accounts
6. NOW content
7. Business portal
8. SEO, analytics, performance and security
9. Data migration from the existing WordPress site
10. Production deployment

The existing WordPress theme remains untouched on `main`. The standalone application is developed on `platform-next` under `/web` until the new platform is ready for cutover.
