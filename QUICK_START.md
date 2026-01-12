# TSScout Pro - Quick Start Guide

## ⚡ Deploy These Changes NOW

### 1️⃣ Push to GitHub (2 minutes)
```bash
git push origin main
```
✅ CI/CD will auto-deploy to frontend servers

### 2️⃣ Update Production .env (5 minutes)

SSH into **BOTH** frontend servers and add these lines to `.env`:

```bash
# Server 1
ssh user@84.32.84.105

# Server 2
ssh user@84.32.84.201

# Add to /path/to/tsscout.com/.env:
BACKEND_API_URL=https://tsscout.ai/api
BACKEND_API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021
BACKEND_API_TIMEOUT=120

# Clear Laravel cache
php artisan optimize:clear
```

### 3️⃣ Check Backend is Running (2 minutes)

```bash
# SSH into backend
ssh root@199.192.25.89

# Run diagnostic script
bash /path/to/diagnose-backend.sh

# Or manually check
pm2 status
curl http://localhost:3000/api/health
```

**If backend is down:**
```bash
cd /var/www/scouter-pro
pm2 restart scouter-pro-api
# Or: pm2 start server.js --name scouter-pro-api
```

### 4️⃣ Clear Hostinger CDN (2 minutes)

1. Login to **Hostinger hPanel**
2. Go to: **Website → Manage → Performance**
3. Click: **"Purge Cache"**

### 5️⃣ Test It Works (1 minute)

```bash
# Test health check
curl https://tsscout.com/api/scouter-pro/health

# Test search
curl -X POST https://tsscout.com/api/scouter-pro/search \
  -H "Content-Type: application/json" \
  -d '{"keyword":"phone case","profitMargin":0.30,"salesThreshold":10,"maxResults":5}'
```

Or visit: **https://tsscout.com/ai-tool** and search for "phone case"

---

## 🐛 Quick Troubleshooting

### Problem: "CSRF token mismatch"
**Solution:** Make sure you pushed the changes and cleared Laravel cache
```bash
php artisan config:clear
php artisan cache:clear
```

### Problem: "Backend API unhealthy"
**Solution:** Backend is down, restart PM2
```bash
ssh root@199.192.25.89
pm2 restart scouter-pro-api
```

### Problem: "Connection refused"
**Solution:** Port 3000 not listening, start the backend
```bash
cd /var/www/scouter-pro
pm2 start server.js --name scouter-pro-api
```

### Problem: Still seeing old code
**Solution:** Clear all caches
- Purge Hostinger CDN (hPanel)
- Clear Laravel: `php artisan optimize:clear`
- Hard refresh browser: `Ctrl+Shift+R` or `Cmd+Shift+R`

---

## 📋 What Changed

### Files Modified:
1. **bootstrap/app.php** - Excluded `api/*` from CSRF protection
2. **.env.example** - Added backend API configuration
3. **DEPLOYMENT_GUIDE.md** - Comprehensive deployment docs
4. **scripts/diagnose-backend.sh** - Backend diagnostic tool

### Why This Fixes It:
- Previously: Laravel blocked POST requests to `/api/scouter-pro/search` due to CSRF protection
- Now: API routes are excluded from CSRF, allowing JavaScript fetch calls to work
- Result: Search functionality works without CSRF errors

---

## 🎯 Success Criteria

✅ All green means you're good to go:

```bash
# Frontend health
curl https://tsscout.com/api/scouter-pro/health
# Expected: {"status":"healthy","backend_api":true,"timestamp":"..."}

# Backend health
curl https://tsscout.ai/api/health
# Expected: {"status":"ok"}

# PM2 status
pm2 status
# Expected: scouter-pro-api | online

# Search test
# Visit https://tsscout.com/ai-tool
# Search "phone case"
# Expected: Results display in table
```

---

## 📞 Need Help?

See **DEPLOYMENT_GUIDE.md** for detailed troubleshooting.

Run diagnostic script on backend server:
```bash
bash /path/to/scripts/diagnose-backend.sh
```

---

**Total Time:** ~15 minutes
**Last Updated:** January 11, 2026
