import Link from 'next/link'
import type { Venue } from '@/lib/data'
import FavoriteButton from './favorite-button'

export default function VenueCard({ venue }: { venue: Venue }) {
  return (
    <article className="venue-card">
      <Link href={`/venues/${venue.slug}`} className="venue-card-link">
        <div className="venue-image" style={{ backgroundImage: `linear-gradient(135deg, rgba(18,18,15,.15), rgba(18,18,15,.72)), url(${venue.image})` }}>
          <span>{venue.type}</span>
          {venue.featured && <b className="featured-badge">精選</b>}
        </div>
        <div className="venue-body">
          <div className="venue-meta"><span>{venue.city}・{venue.district}</span><b className={venue.status === '營業中' ? 'is-open' : 'is-closed'}>{venue.status}</b></div>
          <h3>{venue.name}</h3>
          <p>{venue.description}</p>
          <div className="tag-row">{venue.tags.slice(0, 4).map((tag) => <span key={tag}>{tag}</span>)}</div>
        </div>
      </Link>
      <div className="venue-card-favorite"><FavoriteButton slug={venue.slug} /></div>
    </article>
  )
}
