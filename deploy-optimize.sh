#!/bin/bash
# ----------------------------------------------------------------------
# TAVARDT Elite Laravel Production Deploy & Optimize
# ----------------------------------------------------------------------
# Description: Automates the caching of configuration, routes, and views,
# drastically reducing server response times. It also safely restarts 
# queue workers to pick up new code without interrupting active jobs.

APP_DIR="/var/www/html/laravel"
PHP_BIN="php"

echo "[TAVARDT] Starting Laravel Production Optimization Sequence..."

cd $APP_DIR

# 1. Put the application into maintenance mode (with secret bypass if needed)
# $PHP_BIN artisan down --secret="tavardt-deploy-bypass"

# 2. Clear old caches entirely to prevent conflicts
echo "Clearing application cache..."
$PHP_BIN artisan optimize:clear

# 3. Cache Configuration (Combines all config files into one for speed)
echo "Caching Configuration..."
$PHP_BIN artisan config:cache

# 4. Cache Routes (Dramatically speeds up route registration in massive apps)
echo "Caching Routes..."
$PHP_BIN artisan route:cache

# 5. Cache Views (Pre-compiles Blade templates)
echo "Caching Blade Views..."
$PHP_BIN artisan view:cache

# 6. Cache Events
echo "Caching Events..."
$PHP_BIN artisan event:cache

# 7. Restart Queue Workers Gracefully
# This tells workers to finish their current job, then die.
# Supervisor (or systemd) will automatically spin them back up with the new code.
echo "Restarting Queue Workers..."
$PHP_BIN artisan queue:restart

# (Optional) If using Laravel Octane (Swoole/RoadRunner) for extreme performance
# echo "Reloading Laravel Octane..."
# $PHP_BIN artisan octane:reload

# 8. Bring application back online
# $PHP_BIN artisan up

echo "[TAVARDT] Laravel successfully optimized for High-Performance Production."
