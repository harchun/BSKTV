import Link from 'next/link'

export function Header() {
  return (
    <header className="site-header">
      <div className="shell header-inner">
        <Link href="/" className="brand" aria-label="BSKTV 首頁">BS<span>KTV</span></Link>
        <nav className="nav" aria-label="主要選單">
          <Link href="/venues">找店家</Link>
          <Link href="/cities">城市</Link>
          <Link href="/now">BSKTV NOW</Link>
        </nav>
        <div className="header-actions">
          <Link href="/login" className="ghost-button">登入</Link>
          <Link href="/for-business" className="gold-button">商家入口</Link>
        </div>
      </div>
    </header>
  )
}
