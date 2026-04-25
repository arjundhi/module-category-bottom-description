# Category Bottom Description for Magento 2

> Free, open-source Magento 2 extension  
> by **Arjun Dhiman** — 
> [Adobe Commerce Certified Master](https://magematch.com/developers/arjun-dhiman)  
> Part of the [MageMatch](https://magematch.com) 
> developer ecosystem

`MageMatch_CategoryBottomDescription` adds a dedicated **Bottom Description** WYSIWYG field to Magento category edit pages.

This attribute is store-view scoped and is intended for content that should appear below the product listing on category pages.

## Features

- Adds a `bottom_description` category attribute.
- Uses Magento's admin WYSIWYG editor.
- Enables HTML output and Page Builder compatibility.
- Includes an optional ready-to-use category layout handle.
- Ships as a Composer-ready Magento 2 module.
- Supports modern Magento 2.4 installations.

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
		class="MageMatch\CategoryBottomDescription\Block\Category\BottomDescription"
		name="category.bottom.description"
		template="MageMatch_CategoryBottomDescription::category/bottom_description.phtml"
		after="category.products.list"
	/>
</referenceContainer>
```

The included template renders the attribute only when the category has content, so it is safe to add globally.

### Disable or override the default layout

- Remove the module block in your custom theme layout if you want full control over placement.
- Reuse the included template `MageMatch_CategoryBottomDescription::category/bottom_description.phtml` in your own block or container.
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

## Release Workflow

For a first public GitHub release, a simple flow is:

```bash
git init
git add .
git commit -m "Initial public release"
git tag -a v1.0.0 -m "Version 1.0.0"
```

If this module lives inside a larger Magento project today, copy `app/code/MageMatch/CategoryBottomDescription` into its own repository root before running the commands above.

## CI

This repository includes `.github/workflows/ci.yml` for a lightweight public CI pipeline. It validates:

- Composer package metadata.
- PHP syntax across the module.
- XML well-formedness for Magento config, UI, and layout files.

Before each release, use `RELEASE_CHECKLIST.md` to verify the package is ready to publish.

---
## Installation
```bash
composer require magematch/module-category-bottom-description
bin/magento module:enable MageMatch_CategoryBottomDescription
bin/magento setup:upgrade
bin/magento cache:clean
```

## Compatibility
- Magento Open Source 2.4.x
- Adobe Commerce 2.4.x
- PHP 8.1, 8.2, 8.3

## Support & Custom Development
Need custom Magento development?  
Find vetted Adobe Commerce developers at  
**[magematch.com](https://magematch.com)**

## License
MIT License — free to use commercially
