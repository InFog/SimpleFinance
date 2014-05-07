$host_name = "simple-finance.dev"
$db_name = "simple_finance"

group { 'puppet': ensure => present }
Exec { path => [ '/bin/', '/sbin/', '/usr/bin/', '/usr/sbin/' ] }
File { owner => 0, group => 0, mode => 0644 }

file { "/dev/shm/${db_name}":
  ensure => directory,
  purge => true,
  force => true,
  owner => vagrant,
  group => vagrant
}

file { "/var/lock/apache2":
  ensure => directory,
  owner => vagrant
}

exec { "ApacheUserChange" :
  command => "sed -i 's/export APACHE_RUN_USER=.*/export APACHE_RUN_USER=vagrant/ ; s/export APACHE_RUN_GROUP=.*/export APACHE_RUN_GROUP=vagrant/' /etc/apache2/envvars",
  require => [ Package["apache"], File["/var/lock/apache2"] ],
  notify  => Service['apache'],
}

class {'apt':
  always_apt_update => true,
}

Class['::apt::update'] -> Package <|
    title != 'python-software-properties'
and title != 'software-properties-common'
|>

    apt::key { '4F4EA0AAE5267A6C': }

apt::ppa { 'ppa:ondrej/php5-oldstable':
  require => Apt::Key['4F4EA0AAE5267A6C']
}

package { [
    'build-essential',
    'vim',
    'curl',
    'git-core',
    'mc'
  ]:
  ensure  => 'installed',
}

class { 'apache': }

apache::dotconf { 'custom':
  content => 'EnableSendfile Off',
}

apache::module { 'rewrite': }

apache::vhost { "${host_name}":
  server_name   => "${host_name}",
  serveraliases => [
    "www.${host_name}"
  ],
  docroot       => "/var/www/${host_name}/web/",
  port          => '80',
  env_variables => [
    'VAGRANT VAGRANT'
  ],
  priority      => '1',
}

class { 'php':
  service             => 'apache',
  service_autorestart => false,
  module_prefix       => '',
}

php::module { 'php5-mysql': }
php::module { 'php5-sqlite': }
php::module { 'php5-cli': }
php::module { 'php5-curl': }
php::module { 'php5-intl': }
php::module { 'php5-mcrypt': }
php::module { 'php5-gd': }
php::module { 'php5-xdebug': }
php::module { 'php-apc': }

class { 'php::devel':
  require => Class['php'],
}

class { 'php::pear':
  require => Class['php'],
}

php::pear::module { 'PHPUnit':
  repository  => 'pear.phpunit.de',
  use_package => 'no',
  require => Class['php::pear']
}

php::pecl::module { 'mongo':
    use_package => "no",
}

file {'testfile':
      path    => '/tmp/testfile',
      ensure  => present,
      mode    => 0640,
      content => "I'm a test file.",
    }

class { 'composer':
  command_name => 'composer',
  target_dir   => '/usr/local/bin',
  auto_update => true,
  require => Package['php5', 'curl'],
}


php::ini { 'php_ini_configuration':
  value   => [
    'extension=mongo.so',
    'date.timezone = "UTC"',
    'display_errors = On',
    'error_reporting = -1',
    'short_open_tag = Off',
    'xdebug.remote_autostart=On',
    'xdebug.idekey="PHPSTORM"',
    'xdebug.remote_enable=On',
    'xdebug.remote_handler=dbgp',
    'xdebug.remote_mode=req',
    'xdebug.remote_port=9000',
    'xdebug.remote_autostart=On',
    'xdebug.remote_connect_back=On',
    #'xdebug.remote_log=/tmp/xdebug_remote.log',
    'xdebug.collect_vars=On',
    'xdebug.show_local_vars=On',
    'xdebug.remote_cookie_expire_time=86400',
    'xdebug.var_display_max_data=4096',
    #'xdebug.remote_host=33.33.33.1',
    'xdebug.profiler_enable=On',
    'xdebug.profiler_enable_trigger=On',
    'xdebug.profiler_output_name=cachegrind.%u.%H%R',
    #'xdebug.profiler_output_dir=/tmp/xdebug-profile'
  ],
  notify  => Service['apache'],
  require => Class['php']
}

class { 'mysql::server':
  override_options => {
    'root_password' => '',
    'mysqld' => {
      'bind_address' => '0.0.0.0'
    },
  },
}

mysql_grant { "root@33.33.33.1/*.*":
  ensure     => 'present',
  options    => ['GRANT'],
  privileges => ['ALL'],
  table      => '*.*',
  user       => "root@33.33.33.1",
  require    => Class['mysql::server'],
}

mysql_database{ "${db_name}":
  ensure  => present,
  charset => 'utf8',
  require => Class['mysql::server'],
}

mysql_database{ "${db_name}_dev":
  ensure  => present,
  charset => 'utf8',
  require => Class['mysql::server'],
}

mysql_database{ "${db_name}_test":
  ensure  => present,
  charset => 'utf8',
  require => Class['mysql::server'],
}
