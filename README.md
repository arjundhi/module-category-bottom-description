# Rameera Category Bottom Description

`Rameera_CategoryBottomDescription` adds a dedicated **Bottom Description** WYSIWYG field to Magento category edit pages.

This attribute is store-view scoped and is intended for content that should appear below the product listing on category pages.

## Features

- Adds a `bottom_description` category attribute.
- Uses Magento's admin WYSIWYG editor.
- Enables HTML output and Page Builder compatibility.
- Includes an optional ready-to-use category layout handle.
- Ships as a Composer-ready Magento 2 module.
- Supports modern Magento 2.4 installations.

## Compatibility

- Magento Open Source / Adobe Commerce `2.4.4` and later in the `2.4.x` line.
- PHP `8.1`, `8.2`, `8.3`, and `8.4`.

## Installation

### Install from app/code

Place the module under:

`app/code/Rameera/CategoryBottomDescription`

Then run:

```bash
php bin/magento module:enable Rameera_CategoryBottomDescription
php bin/magento setup:upgrade
php bin/magento cache:flush
```

### Install with Composer (VCS repository)

Add your repository to the project `composer.json`, then require the package:

```bash
composer require arjundhi/module-category-bottom-description
php bin/magento module:enable Rameera_CategoryBottomDescription
php bin/magento setup:upgrade
php bin/magento cache:flush
```

## Usage

After installation:

1. Go to `Catalog > Categories` in the Magento admin.
2. Open any category.
3. Find the **Bottom Description** field in the **Content** section.
4. Save the category.

To render the content on the storefront, output the category attribute in your theme or custom module, for example via the current category model:

```php
$bottomDescription = $currentCategory->getData('bottom_description');
```

This package also includes a reusable example template at `view/frontend/templates/category/bottom_description.phtml` and a supporting block class at `Block/Category/BottomDescription.php`.

The module also ships with `view/frontend/layout/catalog_category_view.xml`, so the bottom description is rendered automatically on category pages after installation.

### Example storefront integration

If you want to override the built-in placement in your theme or custom module layout, add a block like this to `catalog_category_view.xml`:

```xml
<referenceContainer name="content">
	<block
		class="Rameera\CategoryBottomDescription\Block\Category\BottomDescription"
		name="category.bottom.description"
		template="Rameera_CategoryBottomDescription::category/bottom_description.phtml"
		after="category.products.list"
	/>
</referenceContainer>
```

The included template renders the attribute only when the category has content, so it is safe to add globally.

### Disable or override the default layout

- Remove the module block in your custom theme layout if you want full control over placement.
- Reuse the included template `Rameera_CategoryBottomDescription::category/bottom_description.phtml` in your own block or container.
- Override `view/frontend/layout/catalog_category_view.xml` in your theme if you want to move the output elsewhere on category pages.

## Module Structure

- `.github/workflows/ci.yml` runs Composer metadata, PHP lint, and XML validation in GitHub Actions.
- `CHANGELOG.md` tracks public release changes.
- `.gitignore` keeps repository noise out of version control.
- `LICENSE` contains the MIT license for public distribution.
- `Block/Category/BottomDescription.php` provides the current category and rendered bottom description.
- `RELEASE_CHECKLIST.md` provides a quick publish checklist for GitHub releases.
- `registration.php` registers the module.
- `etc/module.xml` declares the Magento module.
- `Setup/CategorySetupFactory.php` provides a setup factory used by the data patch.
- `Setup/Patch/Data/AddBottomDescriptionCategoryAttribute.php` creates or updates the category attribute.
- `view/frontend/layout/catalog_category_view.xml` renders the block automatically on category pages.
- `view/adminhtml/ui_component/category_form.xml` adds the admin form field.
- `view/frontend/templates/category/bottom_description.phtml` contains the storefront rendering example.

## Notes

- Storefront placement remains theme-controlled, but the module now ships with a ready-to-use example block and template.
- If you are replacing an older custom module that used the same attribute code, existing attribute data can still be reused.

## License

This project is licensed under the MIT License. See `LICENSE` for details.

## Release Workflow

For a first public GitHub release, a simple flow is:

```bash
git init
git add .
git commit -m "Initial public release"
git tag -a v1.0.0 -m "Version 1.0.0"
```

If this module lives inside a larger Magento project today, copy `app/code/Rameera/CategoryBottomDescription` into its own repository root before running the commands above.

## CI

This repository includes `.github/workflows/ci.yml` for a lightweight public CI pipeline. It validates:

- Composer package metadata.
- PHP syntax across the module.
- XML well-formedness for Magento config, UI, and layout files.

Before each release, use `RELEASE_CHECKLIST.md` to verify the package is ready to publish.
