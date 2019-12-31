# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.0.0alpha4 - 2018-02-27

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-expressive-authentication#19](https://github.com/zendframework/zend-expressive-authentication/pull/19)
  removes `Mezzio\Authentication\ResponsePrototypeTrait`; the approach
  was flawed, and the various adapters will be updated to compose response
  factories instead of instances.

### Fixed

- Nothing.

## 1.0.0alpha3 - 2018-02-24

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-expressive-authentication#18](https://github.com/zendframework/zend-expressive-authentication/pull/18)
  uses the `ResponseInterface` as a factory. This was recently changed in
  [mezzio#561](https://github.com/zendframework/zend-expressive/pull/561).

## 1.0.0alpha2 - 2018-02-22

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-expressive-authentication#17](https://github.com/zendframework/zend-expressive-authentication/pull/17)
  adds the missing config-provider laminas-component-installer config.


## 1.0.0alpha1 - 2018-02-07

### Added

- [zendframework/zend-expressive-authentication#15](https://github.com/zendframework/zend-expressive-authentication/pull/15)
  adds support for PSR-15.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-expressive-authentication#15](https://github.com/zendframework/zend-expressive-authentication/pull/15) and
  [zendframework/zend-expressive-authentication#3](https://github.com/zendframework/zend-expressive-authentication/pull/3)
  remove support for http-interop/http-middleware and
  http-interop/http-server-middleware.

### Fixed

- Nothing.

## 0.3.0 - 2018-01-24

### Added

- Nothing.

### Changed

- [zendframework/zend-expressive-authentication#14](https://github.com/zendframework/zend-expressive-authentication/issues/14)
  renames the method `UserInterface::getUsername()` to
  `UserInterface::getIdentity()`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-expressive-authentication#13](https://github.com/zendframework/zend-expressive-authentication/pull/13)
  fixes an issue whereby fetching a record by an unknown username resulted in a
  "Trying to get property of non-object" error when using the `PdoDatabase` user
  repository implementation.

## 0.2.0 - 2017-11-27

### Added

- Nothing.

### Changed

- [zendframework/zend-expressive-authentication#4](https://github.com/zendframework/zend-expressive-authentication/pull/4)
  renames the method `UserInterface::getUserRole()` to
  `UserInterface::getUserRoles()`. The method MUST return an array of string
  role names.

- [zendframework/zend-expressive-authentication#4](https://github.com/zendframework/zend-expressive-authentication/pull/4)
  renames the method `UserRepositoryInterface::getRoleFromUser()` to
  `UserRepositoryInterface::getRolesFromUser()`. The method MUST return an array
  of string role names.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.1.0 - 2017-11-08

Initial release.

### Added

- Everything.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
