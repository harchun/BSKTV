import type { Metadata } from 'next'
import './globals.css'
import Header from '@/components/header'
import SiteFooter from '@/components/site-footer'
export const metadata:Metadata={title:{default:'BSKTV｜台灣商務 KTV、酒店與娛樂場所探索平台',template:'%s｜BSKTV'},description:'探索台灣商務 KTV、酒店、KTV 與會館，依城市、類型與關鍵字快速找到適合的店家。',metadataBase:new URL('https://fakertw.com')}
export default function RootLayout({children}:{children:React.ReactNode}){return <html lang="zh-Hant"><body><Header/>{children}<SiteFooter/></body></html>}
