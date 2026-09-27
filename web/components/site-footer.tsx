import Link from 'next/link'

export default function SiteFooter() {
  return <footer className="site-footer">
    <div className="shell footer-grid">
      <div><div className="brand footer-brand">BS<span>KTV</span></div><p>台灣商務 KTV、酒店與娛樂場所探索平台。</p></div>
      <div><strong>探索</strong><Link href="/venues">找店家</Link><Link href="/cities">城市</Link><Link href="/now">BSKTV NOW</Link></div>
      <div><strong>服務</strong><Link href="/favorites">我的收藏</Link><Link href="/login">會員登入</Link><Link href="/for-business">商家合作</Link></div>
      <div><strong>BSKTV</strong><Link href="/about">關於我們</Link><Link href="/terms">使用條款</Link><Link href="/privacy">隱私政策</Link></div>
    </div>
    <div className="shell footer-bottom"><span>© {new Date().getFullYear()} BSKTV</span><span>讓每一次夜生活探索，都更有方向。</span></div>
  </footer>
}
