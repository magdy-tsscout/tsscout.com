#!/bin/bash
# Script to update production .env files on frontend servers
# Run this on EACH frontend server (84.32.84.105 and 84.32.84.201)

echo "Updating Production .env for TSScout Frontend"
echo "================================================"
echo ""

# Find the .env file location (adjust path if needed)
ENV_FILE_PATHS=(
    "/home/u457557566/domains/tsscout.com/public_html/.env"
    "/var/www/tsscout.com/.env"
    "/home/tsscout/.env"
    "$(pwd)/.env"
)

ENV_FILE=""
for path in "${ENV_FILE_PATHS[@]}"; do
    if [ -f "$path" ]; then
        ENV_FILE="$path"
        echo "Found .env file at: $ENV_FILE"
        break
    fi
done

if [ -z "$ENV_FILE" ]; then
    echo "ERROR: Could not find .env file"
    echo "Please manually locate your .env file and run:"
    echo "  nano /path/to/your/.env"
    exit 1
fi

echo ""
echo "Backing up current .env..."
cp "$ENV_FILE" "${ENV_FILE}.backup.$(date +%Y%m%d_%H%M%S)"
echo "Backup created: ${ENV_FILE}.backup.$(date +%Y%m%d_%H%M%S)"

echo ""
echo "Checking if backend config already exists..."
if grep -q "BACKEND_API_URL" "$ENV_FILE"; then
    echo "WARNING: Backend configuration already exists in .env"
    echo "Current values:"
    grep "BACKEND_API" "$ENV_FILE"
    echo ""
    read -p "Do you want to update these values? (y/n): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "Skipping update"
        exit 0
    fi
    # Remove old values
    sed -i.bak '/BACKEND_API_URL/d' "$ENV_FILE"
    sed -i.bak '/BACKEND_API_KEY/d' "$ENV_FILE"
    sed -i.bak '/BACKEND_API_TIMEOUT/d' "$ENV_FILE"
fi

echo ""
echo "Adding backend configuration to .env..."
cat >> "$ENV_FILE" << 'EOF'

# Backend API Configuration
BACKEND_API_URL=https://tsscout.ai/api
BACKEND_API_KEY=1d95bfb7-b38a-50e4-b5f9-cb348deb4021
BACKEND_API_TIMEOUT=120
EOF

echo "Backend configuration added"

echo ""
echo "Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

echo ""
echo "DONE! Production .env updated successfully"
echo ""
echo "Verify the changes:"
echo "  cat $ENV_FILE | grep BACKEND_API"
echo ""
echo "Test the health endpoint:"
echo "  curl https://tsscout.com/api/scouter-pro/health"
