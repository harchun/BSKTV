'use client'
import Link from 'next/link'
import { FormEvent } from 'react'
export default function LoginPage(){function submit(e:FormEvent){e.preventDefault();alert('會員系統正在建置中。現在可先使用收藏功能。')}return <main><section className="auth-page"><div className="auth-card"><p className="eyebrow">WELCOME TO BSKTV</p><h1>登入 BSKTV</h1><p>登入後可以同步收藏、建立推薦與管理你的內容。</p><form onSubmit={submit}><label>Email<input type="email" required placeholder="you@example.com"/></label><label>密碼<input type="password" required minLength={6} placeholder="至少 6 個字元"/></label><button className="gold-button full-button">登入</button></form><div className="auth-divider">或</div><Link href="/venues" className="ghost-button full-button">先逛店家，不登入</Link><small>正式會員驗證與社群功能將接入後端身份系統。</small></div></section></main>}
