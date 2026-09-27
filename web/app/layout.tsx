import type { Metadata } from 'next'
import './globals.css'
import { Header } from '@/components/header'

export const metadata: Metadata = {
  title: 'BSKTV｜台灣商務 KTV・酒店探索平台',
  description: '探索台灣商務 KTV、酒店與娛樂場所，依城市、類型與關鍵字快速找到店家。',
}

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="zh-Hant">
      <body>
        <Header />
        {children}
      </body>
    </html>
  )
}
