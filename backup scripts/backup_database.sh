#!/bin/bash
# Variables
DB_NAME="childsafe"
DB_USER="root"
DB_PASS=""
BACKUP_DIR="/opt/lampp/htdocs/childsafe/backup_scripts/backups"
DATE=$(date +%Y%m%d%H%M%S)
BACKUP_FILE="$BACKUP_DIR/$DB_NAME-$DATE.sql"

# Ensure the backup directory exists
mkdir -p $BACKUP_DIR

# Create a backup
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_FILE

# Optional: Compress the backup file
gzip $BACKUP_FILE

# Optional: Remove backups older than 7 days
find $BACKUP_DIR -type f -name "*.sql.gz" -mtime +7 -exec rm {} \;
