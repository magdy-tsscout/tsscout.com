# TSScout Pro - Deployment & Troubleshooting Guide

## 🏗️ System Architecture

```
User Browser (https://tsscout.com/ai-tool)
    ↓
Hostinger CDN (hcdn)
    ↓
Laravel Frontend (tsscout.com) - Servers: 84.32.84.105, 84.32.84.201
    ↓ API calls to /api/scouter-pro/search
    ↓
Express.js Backend (tsscout.ai) - VPS: 199.192.25.89
    ↓ Nginx proxy: /api/* → localhost:3000
    ↓
Express.js App (Port 3000) - PM2: scouter-pro-api
    ↓
External API (http://164.90.165.80/shopify-api/)
```

## 📋 Recent Changes (Jan 2026)

### Frontend Changes:
1. **CSRF Exception Added** - `bootstrap/app.php`
   - Excluded `api/*` routes from CSRF protection
   - Allows POST requests to `/api/scouter-pro/search` without CSRF token

2. **Environment Variables** - `.env.example`
   - Added `BACKEND_API_URL=https://tsscout.ai/api`
   - Added `BACKEND_API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021`
   - Added `BACKEND_API_TIMEOUT=120`

3. **Laravel Routes** - `routes/web.php`
   - `GET /ai-tool` → Display Scouter Pro interface
   - `POST /api/scouter-pro/search` → Proxy to backend API
   - `GET /api/scouter-pro/health` → Health check

4. **Controller** - `app/Http/Controllers/ScouterProController.php`
   - Validates frontend requests
   - Proxies to backend with authentication
   - Applies client-side filtering

## 🚀 Deployment Steps

### Step 1: Deploy Frontend Changes

```bash
# On local machine
cd /Users/robishy/Documents/TSScout/Scouter_pro/tsscout.com-main

# Commit changes
git add bootstrap/app.php .env.example
git commit -m "Fix: Exclude API routes from CSRF protection and add backend config"
git push origin main

# CI/CD will auto-deploy to frontend servers
```

### Step 2: Update Production Environment Variables

SSH into **both frontend servers** and add to `.env`:

```bash
# Server 1: 84.32.84.105
ssh user@84.32.84.105

# Server 2: 84.32.84.201
ssh user@84.32.84.201

# Add to .env file (location: /home/u457557566/domains/tsscout.com/public_html/.env)
nano /path/to/tsscout.com/.env

# Add these lines:
BACKEND_API_URL=https://tsscout.ai/api
BACKEND_API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021
BACKEND_API_TIMEOUT=120

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

### Step 3: Verify Backend is Running

```bash
# SSH into backend server
ssh root@199.192.25.89

# Check PM2 status
pm2 status

# Should show:
# ┌─────┬──────────────────┬─────────┬─────────┬──────────┐
# │ id  │ name             │ mode    │ ↺       │ status   │
# ├─────┼──────────────────┼─────────┼─────────┼──────────┤
# │ 0   │ scouter-pro-api  │ fork    │ 0       │ online   │
# └─────┴──────────────────┴─────────┴─────────┴──────────┘

# Test locally
curl http://localhost:3000/api/health
# Expected: {"status":"ok"}

# Test externally
curl https://tsscout.ai/api/health
# Expected: {"status":"ok"}
```

### Step 4: Clear CDN Cache

1. **Login to Hostinger hPanel**
2. Navigate to: **Website → Manage → Performance**
3. Click: **"Purge Cache"** or **"Clear CDN Cache"**

### Step 5: Verify End-to-End

```bash
# Test the full flow
curl -X POST https://tsscout.com/api/scouter-pro/search \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "keyword": "phone case",
    "profitMargin": 0.30,
    "salesThreshold": 10,
    "maxResults": 5
  }'

# Should return: {"success":true,"data":{"results":[...]}}
```

## 🔍 Troubleshooting Guide

### Issue 1: "CSRF token mismatch"

**Cause:** API routes still have CSRF protection enabled

**Solution:**
```bash
# Verify bootstrap/app.php has the exception
grep -A 3 "validateCsrfTokens" bootstrap/app.php

# Should show:
# $middleware->validateCsrfTokens(except: [
#     'api/*',
# ]);

# If missing, add it and redeploy
```

### Issue 2: Backend API Unhealthy

**Cause:** Express.js app not running or crashed

**Solution:**
```bash
# SSH into backend
ssh root@199.192.25.89

# Check PM2 logs
pm2 logs scouter-pro-api --lines 100

# Restart if needed
pm2 restart scouter-pro-api

# Check if port 3000 is listening
netstat -tlnp | grep 3000

# If not running, start fresh
cd /var/www/scouter-pro/
npm install
pm2 delete scouter-pro-api
pm2 start server.js --name scouter-pro-api
pm2 save
```

### Issue 3: 404 Not Found on /api/* Routes

**Cause:** Nginx not proxying `/api/` requests to Express

**Solution:**
```bash
# Check Nginx config
cat /www/server/panel/vhost/nginx/tsscout.ai.conf | grep -A 10 "location /api"

# Should have:
# location /api/ {
#     proxy_pass http://localhost:3000;
#     ...
# }

# If missing, add the location block and reload:
nginx -t
systemctl reload nginx
```

### Issue 4: Old JavaScript Cached in Browser

**Cause:** Browser or CDN serving old version

**Solution:**
- Clear Hostinger CDN cache (Step 4 above)
- Hard refresh browser: `Ctrl+Shift+R` (Windows) or `Cmd+Shift+R` (Mac)
- Test in Incognito/Private mode

### Issue 5: External API Not Responding

**Cause:** `http://164.90.165.80/shopify-api/` is down

**Solution:**
```bash
# SSH into backend
ssh root@199.192.25.89

# Test external API
curl http://164.90.165.80/shopify-api/health

# Check backend logs for errors
pm2 logs scouter-pro-api | grep "164.90.165.80"

# If external API is down, contact the API provider
```

## 🧪 Testing Checklist

After deployment, verify each component:

### Frontend Tests:
- [ ] Visit `https://tsscout.com/ai-tool` - page loads correctly
- [ ] Open DevTools → Network tab
- [ ] Enter search keyword: "phone case"
- [ ] Click Search button
- [ ] Verify request goes to `/api/scouter-pro/search` (not `/api/search`)
- [ ] Verify response status: 200 OK
- [ ] Verify results display in table

### Backend Tests:
- [ ] `curl https://tsscout.ai/api/health` → `{"status":"ok"}`
- [ ] `pm2 status` → scouter-pro-api is "online"
- [ ] `netstat -tlnp | grep 3000` → port is listening
- [ ] Check PM2 logs for no errors: `pm2 logs --lines 50`

### Integration Tests:
- [ ] Search returns products
- [ ] Filters work (rating, avgSales, minProfit)
- [ ] Sorting works (by profit, sales, rating)
- [ ] Pagination works
- [ ] Export functionality works

## 📞 Quick Command Reference

### Frontend (Laravel) - Servers: 84.32.84.105, 84.32.84.201
```bash
# Clear all caches
php artisan optimize:clear

# Specific caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check routes
php artisan route:list | grep scouter-pro

# Test health check
curl https://tsscout.com/api/scouter-pro/health
```

### Backend (Express) - Server: 199.192.25.89
```bash
# PM2 commands
pm2 status
pm2 restart scouter-pro-api
pm2 logs scouter-pro-api --lines 100
pm2 save

# Test locally
curl http://localhost:3000/api/health

# Check port
netstat -tlnp | grep 3000

# Restart Nginx
nginx -t
systemctl reload nginx

# View backend directory
ls -la /var/www/scouter-pro/
```

## 🔐 Environment Variables

### Frontend (.env on tsscout.com servers)
```env
APP_URL=https://tsscout.com
BACKEND_API_URL=https://tsscout.ai/api
BACKEND_API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021
BACKEND_API_TIMEOUT=120

DB_CONNECTION=mysql
DB_HOST=82.180.138.52
DB_DATABASE=u457557566_Scout
DB_USERNAME=u457557566_Scout_Admin
DB_PASSWORD=6#nNeKB*3VCo
```

### Backend (.env on 199.192.25.89)
```env
PORT=3000
NODE_ENV=production
API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021
EXTERNAL_API_URL=http://164.90.165.80/shopify-api/
EXTERNAL_API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021
```

## 📊 Monitoring

### Check System Health
```bash
# Frontend health
curl https://tsscout.com/api/scouter-pro/health

# Backend health
curl https://tsscout.ai/api/health

# PM2 monitoring
pm2 monit

# PM2 web dashboard
pm2 web
```

### Logs
```bash
# Backend logs
pm2 logs scouter-pro-api --lines 200

# Nginx access logs
tail -f /var/log/nginx/access.log | grep "/api/"

# Nginx error logs
tail -f /var/log/nginx/error.log
```

## 🎯 Success Criteria

The deployment is successful when:

1. ✅ Frontend loads: `https://tsscout.com/ai-tool`
2. ✅ Health check passes: `https://tsscout.com/api/scouter-pro/health`
3. ✅ Backend health passes: `https://tsscout.ai/api/health`
4. ✅ Search returns results for keyword "phone case"
5. ✅ No CSRF errors in browser console
6. ✅ No 404 errors in DevTools Network tab
7. ✅ PM2 shows "online" status
8. ✅ No errors in PM2 logs

## 📝 Notes

- **CSRF Protection:** Disabled for `/api/*` routes to allow POST requests from JavaScript
- **Authentication:** Backend uses Bearer token authentication (API_KEY in .env)
- **Caching:** Multiple layers (Browser → CDN → Laravel) - clear all when deploying
- **PM2:** Auto-restarts backend on crash, logs to `~/.pm2/logs/`
- **CI/CD:** Frontend auto-deploys from GitHub on push to main branch

---

**Last Updated:** January 11, 2026
**Maintainer:** TSScout Development Team
