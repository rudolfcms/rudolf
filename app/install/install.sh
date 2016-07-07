#!/bin/bash

function install_composer() {
	composer install -q
}
function get_value() {
	local text=$1
	local default=$2

	read -p "~ $text [$default]: " value
	if [ ! "$value" ]; then
		value="$default"
	fi
	echo $value
}

if [ ! -e "composer.json" ]; then
    echo "Must be execute in web root!"
    exit 1
fi

if [ -d "app/config" ]; then
	echo "Rudolf already installed!"
	exit 2
fi

echo "============================================="
echo "Rudolf Install Script"
echo "============================================="

printf "Install composer..."
install_composer
echo " done."

echo ""
echo "- Create catalogs..."
mkdir app/config
mkdir app/log
mkdir app/temp
mkdir content/themes content/themes/front content/themes/admin
mkdir content/uploads
echo done.

printf "Copying files..."
cp -r app/install/config.example/* app/config
echo " done."

echo ""
echo "--- Database config"
database_engine=$(get_value "Engine" "mysql")
database_host=$(get_value "Host" "localhost")
database_name=$(get_value "Name" "rudolf")
database_user=$(get_value "User" "rudolf")
database_pass=$(get_value "Password")
database_charset=$(get_value "Charset" "utf8")
database_prefix=$(get_value "Prefix" "rudolf_")

printf "Saving..."
sed -i "s/engine_value/$database_engine/g" app/config/database.php
sed -i "s/host_value/$database_host/g" app/config/database.php
sed -i "s/database_value/$database_name/g" app/config/database.php
sed -i "s/user_value/$database_user/g" app/config/database.php
sed -i "s/pass_value/$database_pass/g" app/config/database.php
sed -i "s/charset_value/$database_charset/g" app/config/database.php
sed -i "s/prefix_value/$database_prefix/g" app/config/database.php
echo " done."


echo ""
echo "--- Site config"
site_front_theme=$(get_value "Front theme name" "reindeer")
site_admin_theme=$(get_value "Admin theme name" "dasher")
site_general_name=$(get_value "Site general name" "Rudolf → czerwononosy renifer")
site_debug=$(get_value "Debug mode (true|false)" "false")

printf "Saving..."
sed -i "s/front_theme_value/$site_front_theme/g" app/config/site.php
sed -i "s/admin_theme_value/$site_admin_theme/g" app/config/site.php
sed -i "s/general_name_value/$site_general_name/g" app/config/site.php
sed -i "s/'debug_value'/$site_debug/g" app/config/site.php
echo " done."


echo ""
echo "--- Auth config"
auth_key=$(cat /dev/urandom | tr -dc "a-zA-Z0-9!@#$%^&*()_+?><~\`;" | fold -w 48 | head -n 1)

printf "Saving..."
sed -i "s/site_key_value/$auth_key/g" app/config/auth.php
echo " done."

echo ""
echo "========================="
echo "Installation is complete."
