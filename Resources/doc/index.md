Getting Started With CatalogBundle
==================================

## Installation and usage

Installation and usage is a quick:

1. Download CatalogBundle using composer
2. Enable the Bundle
3. Use the bundle
4. Create Your Template


### Step 1: Download CatalogBundle using composer

Add CatalogBundle in your composer.json:

```js
{
    "require": {
        "fdevs/catalog-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update fdevs/catalog-bundle
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FDevs\CatalogBundle\FDevsCatalogBundle(),
    );
}
```

add config

``` yaml
# app/config/config.yml
f_devs_catalog:
    item_types:
        portfolio: 'portfolio'
        our_own_projects: 'Our own projects'
        open_source: 'Open source'


#add Sonata Admins Edits
sonata_admin:
    dashboard:
        groups:
            label.catalog:
                label_catalogue: FDevsCatalogBundle
                items:
                    - f_devs_catalog.admin.item
```


### Step 3: Use the bundle

in your template

``` twig
{{ catalog_list('portfolio',{'tpl_item':'FDevsCoreBundle:Catalog:portfolio_item.html.twig'}) }}
```

### Step 4: Create Your Template

``` twig
{#src/FDevs/CoreBundle/Resources/views/Catalog/portfolio_item.html.twig#}

{% spaceless %}
    <div class="col-md-4 col-sm-6 portfolio-item">
        <a href="#{{ item.id }}" class="portfolio-link" data-toggle="modal">
            <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                    <i class="fa fa-plus fa-3x"></i>
                </div>
            </div>
            <img src="{{ thumb(item.image,'small','catalog') }}" class="img-responsive" alt="">
        </a>

        <div class="portfolio-caption">
            <h4>{{ item.title|t }}</h4>

            <p class="text-muted">{{ item.description|t }}</p>
        </div>
    </div>
{% endspaceless %}
```
