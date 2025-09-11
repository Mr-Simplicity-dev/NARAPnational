# MyTime360 Backend (Express + MongoDB)

This backend serves your current frontend **unchanged** and adds APIs + uploads + admin auth.
Your uploaded `index.html` is copied as-is to `public/index.html` so all classes/IDs remain intact.

## Quick Start

```bash
cp .env.example .env   # then edit values
npm install
npm run dev
```

- Server: http://localhost:${PORT:-5000}
- Static site: `public/` (your index.html is already placed there)
- Admin uploads are written under `public/admin/uploads/<folder>`

## API Overview (Public)

- `GET /api/blogs` — list
- `GET /api/blogs/:slug` — detail
- `GET /api/services` — list
- `GET /api/portfolio` — list
- `GET /api/sliders` — list
- `GET /api/team` — list
- `GET /api/faqs` — list
- `GET /api/offers` — list

## API Overview (Admin, JWT required)

- `POST /api/auth/register` — create admin
- `POST /api/auth/login` — login
- `POST /api/upload?folder=blogs|services|portfolio|team|sections|offer|slider|about` — multipart/form-data `file`
- CRUD: `POST/PUT/DELETE` to the above resources (see routes files)

## PHP Link Compatibility

Your HTML links to URLs like `admin/login.php`, `post.php?slug=...`, `blog.php` etc.
This server serves **static files** with `.php` extensions (treated as HTML) so those links won't 404.
Dynamic content is provided by JSON APIs. You can progressively wire these pages to fetch from the APIs.

## Notes

- Keep your existing CSS/JS exactly under `public/css` & `public/js`.
- Uploaded media become accessible at `/admin/uploads/...` which matches paths used in your HTML.
- For production, set a real `JWT_SECRET`, `MONGO_URI`, and consider a reverse proxy + HTTPS.
