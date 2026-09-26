# BSKTV WordPress Theme

BSKTV 是「台灣商務 KTV／酒店店家資訊平台」專用 WordPress Theme。

## 產品定位

核心使用流程只有三件事：

1. 找店家
2. 了解店家
3. 透過 LINE 聯絡

前台不做成一般部落格，也不自動推算消費總額。

## 核心資料模型

一篇 WordPress 原生文章 = 一家店。

- Post：店家主體、文章介紹、特色圖片
- Taxonomy：
  - bsktv_city：城市
  - bsktv_type：店家類型
  - bsktv_feature：店家特色
- Post Meta：
  - bsktv_status
  - bsktv_verified
  - bsktv_verified_at
  - bsktv_address
  - bsktv_hours
  - bsktv_service_mode
  - bsktv_room_fee
  - bsktv_host_fee
  - bsktv_person_fee
  - bsktv_girl_fee
  - bsktv_head_fee
  - bsktv_line_url_override
  - bsktv_views
  - bsktv_line_clicks
  - bsktv_featured
  - bsktv_home_featured

## 前台資訊規則

店家詳細頁提供：

- 地址
- 營業時間
- 坐檯模式
- 包廂費用
- 少爺費用
- 人頭費用
- 小姐費用
- 幹部費用
- LINE

以下功能明確不屬於 BSKTV：

- 電話
- Google Maps
- 官方網站
- 消費試算
- 自動產生的消費資訊

文章正文中的消費方案由管理員自行撰寫。

## 前台頁面

### 首頁

Hero 搜尋 → 城市 → 店家類型 → 精選店家 → 最新收錄 → Footer。

首頁統計只反映目前有效的營業中店家與有內容的分類。

### 店家列表

搜尋、分類篩選、店家卡片、載入更多／分頁。

### 搜尋頁

搜尋結果、結果數量、無結果狀態、錯誤狀態。

### 店家詳細頁

照片、名稱、城市／類型、狀態、介紹、店家資訊、費用、相簿、LINE。

### 我的收藏

使用瀏覽器 LocalStorage，不需要會員登入。

## UI／UX 原則

- Mobile First
- 統一 Button / Card / Badge / Form
- 清楚的 Loading / Empty / Error 狀態
- 重要觸控區域以手機操作為優先
- 支援鍵盤 Focus、ESC、Reduced Motion
- 不讓 AJAX 失敗變成空白頁面

## 技術原則

- WordPress 原生 Theme
- 不依賴 WooCommerce
- 前台資料共用統一的「有效店家」規則
- 輸入資料先 sanitize，輸出資料 escape
- AJAX 使用 Nonce
- 前台查詢不得任意覆蓋其他 Meta Query
- 圖片使用 WordPress responsive image API
- CSS / JS 使用 Theme Version 做 cache busting
- 保留 PHP 8.2 CI Lint

## 開發順序

1. 資料與架構盤點
2. Design System
3. Global Header / Footer
4. 首頁
5. 搜尋／列表／分類
6. 店家詳細頁
7. AJAX／收藏／Gallery／LINE
8. 後台管理
9. SEO／效能／安全
10. 完整測試與部署

每個階段完成後，先確認既有功能沒有回歸，再進入下一階段。
