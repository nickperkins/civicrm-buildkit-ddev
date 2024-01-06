# CiviCRM Buildkit with DDEV

This project provides a DDEV-based environment for working with [CiviCRM Buildkit](https://github.com/civicrm/civicrm-buildkit).

## Getting Started

1. Clone this repository.
2. Navigate to the project directory.
3. Run `ddev start`.

## Usage

Once the DDEV environment is running, you can use the `civibuild` command to
create a new CiviCRM site.

For example, to create a site based on the build type `drupal10-clean`, you would
run:

```bash
ddev exec civibuild create drupal10-clean
```

The site will be available at <https://drupal10-clean.civicrm.ddev.site>

You can interact with the buildkit tools directly, you can start shell session
inside the web container by running:

```bash
ddev ssh
```

You can view a list of the currently installed site by visiting the project root's
website, which by default is available at <https://civicrm-buildkit-ddev.ddev.site>

## Contributing

Contributions are welcome! Please read our [contributing guidelines](CONTRIBUTING.md)
for details.

## License

This project is licensed under the terms of the GNU Affero General Public
License v3.0 (AGPL-3.0) - see the [LICENSE](LICENSE) file for details.
