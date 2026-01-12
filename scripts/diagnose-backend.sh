#!/bin/bash

# TSScout Pro - Backend Diagnostic Script
# Run this on the backend server (199.192.25.89) to diagnose issues

echo "========================================="
echo "TSScout Pro - Backend Diagnostics"
echo "========================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. Check PM2 Status
echo "1. PM2 Process Status:"
echo "-------------------"
pm2 status
echo ""

# 2. Check if port 3000 is listening
echo "2. Port 3000 Status:"
echo "-------------------"
if netstat -tlnp 2>/dev/null | grep -q ":3000"; then
    echo -e "${GREEN}[OK] Port 3000 is listening${NC}"
    netstat -tlnp | grep ":3000"
else
    echo -e "${RED}[FAIL] Port 3000 is NOT listening${NC}"
fi
echo ""

# 3. Test local health endpoint
echo "3. Local Health Check (http://localhost:3000/api/health):"
echo "-------------------"
HEALTH_LOCAL=$(curl -s -w "\n%{http_code}" http://localhost:3000/api/health 2>&1)
HTTP_CODE=$(echo "$HEALTH_LOCAL" | tail -n1)
RESPONSE=$(echo "$HEALTH_LOCAL" | head -n-1)

if [ "$HTTP_CODE" = "200" ]; then
    echo -e "${GREEN}[OK] Health check passed${NC}"
    echo "Response: $RESPONSE"
else
    echo -e "${RED}[FAIL] Health check failed (HTTP $HTTP_CODE)${NC}"
    echo "Response: $RESPONSE"
fi
echo ""

# 4. Test external health endpoint
echo "4. External Health Check (https://tsscout.ai/api/health):"
echo "-------------------"
HEALTH_EXT=$(curl -s -w "\n%{http_code}" https://tsscout.ai/api/health 2>&1)
HTTP_CODE_EXT=$(echo "$HEALTH_EXT" | tail -n1)
RESPONSE_EXT=$(echo "$HEALTH_EXT" | head -n-1)

if [ "$HTTP_CODE_EXT" = "200" ]; then
    echo -e "${GREEN}[OK] External health check passed${NC}"
    echo "Response: $RESPONSE_EXT"
else
    echo -e "${RED}[FAIL] External health check failed (HTTP $HTTP_CODE_EXT)${NC}"
    echo "Response: $RESPONSE_EXT"
fi
echo ""

# 5. Check backend directory
echo "5. Backend Directory:"
echo "-------------------"
if [ -d "/var/www/scouter-pro" ]; then
    echo -e "${GREEN}[OK] Directory exists${NC}"
    ls -lh /var/www/scouter-pro/ | head -10
else
    echo -e "${RED}[FAIL] Directory not found${NC}"
fi
echo ""

# 6. Check .env file
echo "6. Environment Configuration:"
echo "-------------------"
if [ -f "/var/www/scouter-pro/.env" ]; then
    echo -e "${GREEN}[OK] .env file exists${NC}"
    echo "PORT: $(grep PORT /var/www/scouter-pro/.env)"
    echo "NODE_ENV: $(grep NODE_ENV /var/www/scouter-pro/.env)"
    echo "API_KEY: $(grep API_KEY /var/www/scouter-pro/.env | head -1)"
else
    echo -e "${RED}[FAIL] .env file not found${NC}"
fi
echo ""

# 7. Check Nginx configuration
echo "7. Nginx Configuration:"
echo "-------------------"
if [ -f "/www/server/panel/vhost/nginx/tsscout.ai.conf" ]; then
    echo -e "${GREEN}[OK] Nginx config exists${NC}"
    echo "API location block:"
    grep -A 10 "location /api" /www/server/panel/vhost/nginx/tsscout.ai.conf || echo -e "${RED}[FAIL] No /api location block found${NC}"
else
    echo -e "${YELLOW}[WARN] Nginx config path may be different${NC}"
    echo "Checking alternative locations..."
    find /etc/nginx -name "*tsscout.ai*" 2>/dev/null || echo "No Nginx config found"
fi
echo ""

# 8. Check PM2 logs (last 20 lines)
echo "8. Recent PM2 Logs:"
echo "-------------------"
pm2 logs scouter-pro-api --lines 20 --nostream 2>&1 || echo -e "${RED}[FAIL] Could not retrieve logs${NC}"
echo ""

# 9. Test external API dependency
echo "9. External API Check (http://164.90.165.80/shopify-api/):"
echo "-------------------"
EXT_API=$(curl -s -w "\n%{http_code}" -m 5 http://164.90.165.80/shopify-api/health 2>&1)
EXT_HTTP_CODE=$(echo "$EXT_API" | tail -n1)

if [ "$EXT_HTTP_CODE" = "200" ]; then
    echo -e "${GREEN}[OK] External API is reachable${NC}"
else
    echo -e "${YELLOW}[WARN] External API check inconclusive (HTTP $EXT_HTTP_CODE)${NC}"
fi
echo ""

# 10. Summary
echo "========================================="
echo "Summary:"
echo "========================================="
ISSUES=0

if ! pm2 status | grep -q "scouter-pro-api.*online"; then
    echo -e "${RED}[FAIL] PM2 process is not running${NC}"
    ISSUES=$((ISSUES+1))
fi

if ! netstat -tlnp 2>/dev/null | grep -q ":3000"; then
    echo -e "${RED}[FAIL] Port 3000 is not listening${NC}"
    ISSUES=$((ISSUES+1))
fi

if [ "$HTTP_CODE" != "200" ]; then
    echo -e "${RED}[FAIL] Local health check failed${NC}"
    ISSUES=$((ISSUES+1))
fi

if [ "$HTTP_CODE_EXT" != "200" ]; then
    echo -e "${RED}[FAIL] External health check failed${NC}"
    ISSUES=$((ISSUES+1))
fi

if [ $ISSUES -eq 0 ]; then
    echo -e "${GREEN}[OK] All checks passed! Backend is healthy.${NC}"
else
    echo -e "${RED}Found $ISSUES issue(s). See details above.${NC}"
    echo ""
    echo "Quick fixes to try:"
    echo "  1. Restart PM2: pm2 restart scouter-pro-api"
    echo "  2. Check logs: pm2 logs scouter-pro-api --lines 50"
    echo "  3. Reinstall deps: cd /var/www/scouter-pro && npm install"
    echo "  4. Restart Nginx: systemctl reload nginx"
fi
echo ""
