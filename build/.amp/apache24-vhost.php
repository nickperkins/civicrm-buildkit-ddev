<?php
/* Apache Virtual Host Template
 *
 * @var string $root - the local path to the web root
 * @var string $host - the hostname to listen for
 * @var int $port - the port to listen for
 * @var string $include_vhost_file - the local path to a related config file
 * @var string $visibility - which interfaces the vhost is available on
 */

?>

<VirtualHost *:80>
    RewriteEngine On
    RewriteCond %{HTTP:X-Forwarded-Proto} =https
    RewriteCond    %{DOCUMENT_ROOT}%{REQUEST_FILENAME} -d
    RewriteRule    ^(.+[^/])$           https://%{HTTP_HOST}$1/ [redirect,last]

    SetEnvIf X-Forwarded-Proto "https" HTTPS=on

    ServerAdmin webmaster@<?php echo $host ?>

    ServerName <?php echo $host ?>

    DocumentRoot "<?php echo $root ?>"
    <Directory "<?php echo $root ?>">
      AllowOverride All
      Allow from All
      <IfModule mod_authz_host.c>
            Require <?php echo $visibility ?> granted
        </IfModule>
    </Directory>
    # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
    # error, crit, alert, emerg.
    # It is also possible to configure the loglevel for particular
    # modules, e.g.
    #LogLevel info ssl:warn

    ErrorLog /dev/stdout
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    # For most configuration files from conf-available/, which are
    # enabled or disabled at a global level, it is possible to
    # include a line for only one particular virtual host. For example the
    # following line enables the CGI configuration for this host only
    # after it has been globally disabled with "a2disconf".
    #Include conf-available/serve-cgi-bin.conf

    # Increase allowed field size for large cookies header.
    LimitRequestFieldSize 16380

    # Simple ddev technique to get a phpstatus
    Alias "/phpstatus" "/var/www/phpstatus.php"
    Alias "/xhprof" "/var/xhprof/xhprof_html"
    <Directory "/var/xhprof">
        Options Indexes
        AllowOverride None
        Require all granted
    </Directory>

    <?php if (!empty($include_vhost_file)) { ?>
    Include <?php echo $include_vhost_file ?>
    <?php } ?>

</VirtualHost>

<VirtualHost *:443>
    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/master.crt
    SSLCertificateKeyFile /etc/ssl/certs/master.key

    # Workaround from https://mail-archives.apache.org/mod_mbox/httpd-users/201403.mbox/%3C49404A24C7FAD94BB7B45E86A9305F6214D04652@MSGEXSV21103.ent.wfb.bank.corp%3E
    # See also https://gist.github.com/nurtext/b6ac07ac7d8c372bc8eb

    RewriteEngine On
    RewriteCond %{HTTP:X-Forwarded-Proto} =https
    RewriteCond    %{DOCUMENT_ROOT}%{REQUEST_FILENAME} -d
    RewriteRule    ^(.+[^/])$           https://%{HTTP_HOST}$1/ [redirect,last]

    SetEnvIf X-Forwarded-Proto "https" HTTPS=on

    ServerAdmin webmaster@<?php echo $host ?>

    ServerName <?php echo $host ?>

    DocumentRoot "<?php echo $root ?>"
    <Directory "<?php echo $root ?>">
      AllowOverride All
      Allow from All
    </Directory>
    # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
    # error, crit, alert, emerg.
    # It is also possible to configure the loglevel for particular
    # modules, e.g.
    #LogLevel info ssl:warn

    ErrorLog /dev/stdout
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    # Increase allowed field size for large cookies header.
    LimitRequestFieldSize 16380

    # For most configuration files from conf-available/, which are
    # enabled or disabled at a global level, it is possible to
    # include a line for only one particular virtual host. For example the
    # following line enables the CGI configuration for this host only
    # after it has been globally disabled with "a2disconf".
    #Include conf-available/serve-cgi-bin.conf
    # Simple ddev technique to get a phpstatus
    Alias "/phpstatus" "/var/www/phpstatus.php"
    Alias "/xhprof" "/var/xhprof/xhprof_html"
    <Directory "/var/xhprof">
        Options Indexes
        AllowOverride None
        Require all granted
    </Directory>

    <?php if (!empty($include_vhost_file)) { ?>
    Include <?php echo $include_vhost_file ?>
    <?php } ?>

</VirtualHost>
