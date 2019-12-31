# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

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
