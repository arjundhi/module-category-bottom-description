# Release Checklist

Use this checklist before publishing a new GitHub release.

## Code Quality

- Confirm `composer.json` package metadata, repository URLs, and version notes are current.
- Run PHP lint on all module PHP files.
- Confirm XML files are well-formed.
- Test installation with `php bin/magento setup:upgrade` in a Magento 2.4 project.

## Functional Checks

- Verify the **Bottom Description** field appears in `Catalog > Categories > Content`.
- Save category content in at least one store view.
- Confirm the description renders on the storefront category page.
- Confirm empty values do not output a blank wrapper.

## Release Prep

- Update `CHANGELOG.md` with the new version and date.
- Commit all changes with a clear release commit message.
- Create an annotated git tag such as `v1.0.1`.
- Publish a GitHub release with upgrade notes if needed.