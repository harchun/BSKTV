# BSKTV Standalone Web

BSKTV 的獨立網站版本，與舊 WordPress Theme 分離。

## 已完成
- Discovery-first 首頁
- 全站響應式 UI
- 店家目錄、關鍵字搜尋、城市／類型篩選
- 店家詳細頁與相關店家
- 收藏（瀏覽器本地儲存）
- BSKTV NOW 內容入口
- 會員登入入口 UI
- 商家合作入口
- SEO metadata、sitemap、robots
- `/api/venues` 店家搜尋 API
- TypeScript 與 Next.js production build CI

## 技術
- Next.js 15 App Router
- React 19
- TypeScript
- API-first domain model
- CSS Design System

## 啟動
```bash
npm install
npm run dev
```

## 資料層
目前以 `lib/data.ts` 作為可執行 seed data，讓前台與 API 可以直接運作。正式部署階段接 PostgreSQL，將 Venue、User、Favorite、Review、NowPost、BusinessClaim 等模型轉為持久化資料。

## 路由
- `/` 首頁
- `/venues` 店家目錄
- `/venues/[slug]` 店家詳細頁
- `/cities` 城市探索
- `/now` BSKTV NOW
- `/favorites` 收藏
- `/login` 會員入口
- `/for-business` 商家合作
- `/api/venues` 搜尋 API

舊 WordPress Theme 仍保留在 `main`；獨立網站在 `platform-next` 的 `/web` 開發。
