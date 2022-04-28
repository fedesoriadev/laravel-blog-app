<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

## [0.1.0](https://github.com/fedesoriadev/laravel-blog-app/compare/0398643ff7f2c991ab7de61c85747a5629cd16a4...v0.1.0) (2022-04-28)
### Features


##### Admin

* Add admin section index ([680fd9](https://github.com/fedesoriadev/laravel-blog-app/commit/680fd9d5b156a28e3824491219497a370b1171a5))
* Add confirmation buttons ([e13d1e](https://github.com/fedesoriadev/laravel-blog-app/commit/e13d1e0b99100caf159ed4d7b09ac9f0d00477d5))
* Add dropdown and menu mobile to admin section ([db75f0](https://github.com/fedesoriadev/laravel-blog-app/commit/db75f0e2962a574fa2cf552299d9d598bc6c1c09))
* Admin dashboard ([75ac8a](https://github.com/fedesoriadev/laravel-blog-app/commit/75ac8aeed2375302559b1f30977e2b870554b14a))
* Create AdminLayout and place initial design ([d4278a](https://github.com/fedesoriadev/laravel-blog-app/commit/d4278a8f5edf2a97f1e491d5abcb62688ec4b7c5))
* First draft of admin dashboard ([085b3f](https://github.com/fedesoriadev/laravel-blog-app/commit/085b3f8ae52d6ac2493eb95007bf34fbebf53fbc))
* Move header to slot component ([ecd3cb](https://github.com/fedesoriadev/laravel-blog-app/commit/ecd3cbe6a4ab17bd4b41693aae86d4c8339e1508))
* Provide visual feedback upon controller actions ([b0a829](https://github.com/fedesoriadev/laravel-blog-app/commit/b0a829b27fc31b72c7d2015ad05992a34c3f7750))
* Resolve LoginResponse upon user role ([ac0a83](https://github.com/fedesoriadev/laravel-blog-app/commit/ac0a83842a6b01bf558df36e1bfffe3d774b4ed9))

##### Auth

* Add email verification protection ([4f0267](https://github.com/fedesoriadev/laravel-blog-app/commit/4f026725ba79c2b914b0f4f4a3c94421635f0433))
* Complete authentication flow ([310f52](https://github.com/fedesoriadev/laravel-blog-app/commit/310f52812828ad0c9ed162566a35e9d518c1a205))

##### Authors

* Add route and controller to show posts of an author & add username to users ([9abde0](https://github.com/fedesoriadev/laravel-blog-app/commit/9abde0eb1003271ac0185f10d0db38b3ebae7afe))
* Add view for author page ([d01cbe](https://github.com/fedesoriadev/laravel-blog-app/commit/d01cbef240975e0bf9b12194e936eb503792d43c))

##### Comments

* Add comment list and form inside single post ([a9fb72](https://github.com/fedesoriadev/laravel-blog-app/commit/a9fb72654f9b18c7bd02ef812abc4214f8a588a9))
* Add list of comments to admin section ([86efc1](https://github.com/fedesoriadev/laravel-blog-app/commit/86efc13b7bf99d9e2ffe7d1cbe9f0890f56731e6))
* Add relationship between comments, posts and users (author) ([0caa77](https://github.com/fedesoriadev/laravel-blog-app/commit/0caa774c323228c87369e7a5f629f5d5f949d72b))
* Add route and controller for manage comments ([f06d8a](https://github.com/fedesoriadev/laravel-blog-app/commit/f06d8ac9a0c532c06ad80d0465a563fc41e634d4))
* Create comment model and migration ([90a160](https://github.com/fedesoriadev/laravel-blog-app/commit/90a1606676cf3dccf6115c1b65fcdb918ac5b616))

##### Core

* Add checkbox component ([e7423b](https://github.com/fedesoriadev/laravel-blog-app/commit/e7423b1a87f9156f348bfcbeebe88c933b8b6568))
* Add Fortify scaffolding and authentication views and components ([48eda1](https://github.com/fedesoriadev/laravel-blog-app/commit/48eda1a88b84b1e0b2f9471b1bd22b40ef2ddb36))
* Add language support ([103d8a](https://github.com/fedesoriadev/laravel-blog-app/commit/103d8aac22d3178eba4a65ca7065fd8a5f72fb9d))
* Add metatags ([490806](https://github.com/fedesoriadev/laravel-blog-app/commit/490806f85b5f66b6674d76b2c3de1d9571c3a508))

##### Posts

* Add form to create and edit posts ([915d4c](https://github.com/fedesoriadev/laravel-blog-app/commit/915d4cb8c33fd4556500a03577e7d2ac6439b54c))
* Add list of post to admin section ([bcd393](https://github.com/fedesoriadev/laravel-blog-app/commit/bcd393d7ecaa07ffec7d573db9d5330f32c02257))
* Add methods for create and update posts ([8bfd67](https://github.com/fedesoriadev/laravel-blog-app/commit/8bfd679e021c4cbd129f61b88567fa5ae655a6cd))
* Add post policy for admins and editors ([614ad4](https://github.com/fedesoriadev/laravel-blog-app/commit/614ad47e13d3885fe079d3b3b8860d3328515e9a))
* Add published scope & post controller ([9a1ff3](https://github.com/fedesoriadev/laravel-blog-app/commit/9a1ff3f1609082234aaee1eec0f039de3197e23d))
* Add relationship between posts and tags ([751378](https://github.com/fedesoriadev/laravel-blog-app/commit/75137861eb8557202386322040f556f275f52542))
* Add relationship between posts and users (author) ([6bbec3](https://github.com/fedesoriadev/laravel-blog-app/commit/6bbec3be0c9e5ba31aa433d0296b861fdfbedd64))
* Add route and controller method to show a single post if it is published ([b9fc36](https://github.com/fedesoriadev/laravel-blog-app/commit/b9fc36cc1fe2028e10c18a927c52611ee4c771e5))
* Add routes to publish and archive posts ([ce8711](https://github.com/fedesoriadev/laravel-blog-app/commit/ce87110e2d72a879e6328a1b97a4bb248c5aecf3))
* Add search posts by title or body ([2c360f](https://github.com/fedesoriadev/laravel-blog-app/commit/2c360f75eaeaf52bf55677dc4e1e6d5f564695e6))
* Add view for homepage (list of posts) and post component ([588521](https://github.com/fedesoriadev/laravel-blog-app/commit/588521a2e8f575edd2c98ac9c3a83c67e3afb074))
* Admin filter posts by status ([bb3a2f](https://github.com/fedesoriadev/laravel-blog-app/commit/bb3a2f7b08ed87da09e68f1a5b493cf98a3ad4c4))
* A post can be deleted ([6b1664](https://github.com/fedesoriadev/laravel-blog-app/commit/6b1664a1a7515ae926d4b82bb307b4c1e43a0c87))
* A user can create a post ([1acb94](https://github.com/fedesoriadev/laravel-blog-app/commit/1acb94f63a05bed6c250348307e5932e92b5a0e3))
* Create post model and migration ([e990c6](https://github.com/fedesoriadev/laravel-blog-app/commit/e990c6557d1ded4d8871a689851242303742e238))
* Disallow authors to create posts by another user ([7b949b](https://github.com/fedesoriadev/laravel-blog-app/commit/7b949b6f540d2f68edc3baee215620ccb736d9e3))
* Editors only see their posts ([8e4e16](https://github.com/fedesoriadev/laravel-blog-app/commit/8e4e1667bbde1bc8e1e9970f9636f98157e13ae6))
* Form to create and edit posts ([b835b8](https://github.com/fedesoriadev/laravel-blog-app/commit/b835b898bd1063b7bdf8841364cfaefe733de3b5))
* Post statuses on index page ([7afc5a](https://github.com/fedesoriadev/laravel-blog-app/commit/7afc5a2b342bb9dba1f855a9c58f08b8c4497255))
* Show a post view ([603045](https://github.com/fedesoriadev/laravel-blog-app/commit/603045ad5da202c97b72c5b157788498ec95a634))
* Sync tags when saving a post ([595d75](https://github.com/fedesoriadev/laravel-blog-app/commit/595d75f1079e5018ef748c38ed502a3942f2bb3f))

##### Roles

* Add relationship between roles and users ([425eeb](https://github.com/fedesoriadev/laravel-blog-app/commit/425eeb7004a2fb4b7d34f12ddf034a3cdacd50fb))
* Add, remove and check user roles ([6e68e4](https://github.com/fedesoriadev/laravel-blog-app/commit/6e68e4458fe43eb317f1168194dffb02d336d917))
* Create enum UserRole and Arrayable interface ([5571fa](https://github.com/fedesoriadev/laravel-blog-app/commit/5571fade67c5e3c1238f84f4f2d0d546517af8ff))
* Create role model and migration ([46f9fb](https://github.com/fedesoriadev/laravel-blog-app/commit/46f9fb0d65e3c76d673dc0437099bc86347f64e7))

##### Tags

* Add route and controller to show a tag posts ([d631d6](https://github.com/fedesoriadev/laravel-blog-app/commit/d631d63b2e3344235a8dacb2a89d7ee3aa28f06e))
* Add view for tag page ([2d01b9](https://github.com/fedesoriadev/laravel-blog-app/commit/2d01b94795b7310b901dfd0125d30fe2926b4bce))
* Create tag model and migration ([31b3e2](https://github.com/fedesoriadev/laravel-blog-app/commit/31b3e240935189b7c74faca9cb067aff82796155))

##### Ui

* Add alert component ([d5c176](https://github.com/fedesoriadev/laravel-blog-app/commit/d5c1765cb8708c89106a1c1a4d8bf58091dc8e6a))
* Add global layout component ([a02b1a](https://github.com/fedesoriadev/laravel-blog-app/commit/a02b1af9e4578d991fb504b1a43bcb71d0146477))
* Add spatie/laravel-flash package to show messages along with alert component ([2753cc](https://github.com/fedesoriadev/laravel-blog-app/commit/2753cc16938738e2b6d1f692fe1918db2f1966e8))
* Link component ([5ef5b9](https://github.com/fedesoriadev/laravel-blog-app/commit/5ef5b92544ebaba5a9ae5bee8b4fe45fcdce446e))

##### Users

* Add button in admin to resend verification email ([405f78](https://github.com/fedesoriadev/laravel-blog-app/commit/405f78c4b0abeb07de890b888fcee4c800d1e91d))
* Add list of users to admin section ([a0158a](https://github.com/fedesoriadev/laravel-blog-app/commit/a0158ae3d2c718915b8e724d0d4cf1e6760ac2b5))
* Add profile info to users ([fe1754](https://github.com/fedesoriadev/laravel-blog-app/commit/fe1754e67f77dc931effe0dbed0a4d6031c7e80c))
* Add profile section ([cd6de2](https://github.com/fedesoriadev/laravel-blog-app/commit/cd6de2e64deb5a099b837bc24c3547de4db34bb6))
* Add role field to user form ([8249c5](https://github.com/fedesoriadev/laravel-blog-app/commit/8249c5c394d6ede18ec3a02e1b31cc52f615cbf3))
* Add routes and controller for manage users ([f30acc](https://github.com/fedesoriadev/laravel-blog-app/commit/f30acc1e0cf09fd638a6c881aa97d537ca0aecdb))
* Add sizes to user avatar component ([ad88ea](https://github.com/fedesoriadev/laravel-blog-app/commit/ad88ea293cb345e799dab4c35515b328042129c7))
* Admin filter users by role ([556a3e](https://github.com/fedesoriadev/laravel-blog-app/commit/556a3e72a8f30a2d148c7a9daccaf2c41d3fc6b6))
* Form to create and update users ([c768a4](https://github.com/fedesoriadev/laravel-blog-app/commit/c768a4608e30e5c2f71720f11c11dee5579ff64c))

### Bug Fixes


##### Auth

* Fix home link of each role user ([a80293](https://github.com/fedesoriadev/laravel-blog-app/commit/a80293d7be824787cbbc2a95e241267b3b6ece4c))

##### Comments

* Fix redirection after comment was created ([dc7a29](https://github.com/fedesoriadev/laravel-blog-app/commit/dc7a29f9b0d5c630859d609416a65bf5f6eeefa8))
* Show comments in descending order & eager load comment authors ([f9e9b5](https://github.com/fedesoriadev/laravel-blog-app/commit/f9e9b5c2ada4738813723da53aa3edd84e7b0dfd))

##### Core

* Fix missing translation for pagination ([21b3a2](https://github.com/fedesoriadev/laravel-blog-app/commit/21b3a2f6ec1d49ca29f5e0cc581246e9a5ce24f0))
* Fix return type declaration in Language Middleware ([310cdf](https://github.com/fedesoriadev/laravel-blog-app/commit/310cdfa6a4c342f3bae4731c4ee15377df0f4263))

##### Posts

* Fix cover_image accessor when null ([686cd5](https://github.com/fedesoriadev/laravel-blog-app/commit/686cd5bcc337a1ee7e33db3e0204820740822e8c))
* Fix n+1 queries on tag and author show page ([b56cf9](https://github.com/fedesoriadev/laravel-blog-app/commit/b56cf98c6550559a22f898bf1c6398f0e5bb0e93))
* Fix null state when create post ([464996](https://github.com/fedesoriadev/laravel-blog-app/commit/464996aa16b952dc65b5655583dabcfdf6f9cbc3))
* Fix ommited admin posts index ([f4d0cd](https://github.com/fedesoriadev/laravel-blog-app/commit/f4d0cd1d136e02dad9f8f7ae4bb24102ec6e9a85))
* Fix unset post status when create ([437d5e](https://github.com/fedesoriadev/laravel-blog-app/commit/437d5e7057d98ea3c7f851301eb0b01f1b40a2d2))
* Fix user scope withRole for dynamic role argument ([69a9cf](https://github.com/fedesoriadev/laravel-blog-app/commit/69a9cf234d002522f724cee2eefb76208ea898fc))
* Show recent posts first in homepage ([79c3ab](https://github.com/fedesoriadev/laravel-blog-app/commit/79c3ab956436d586b30119e86e3d7f9c812d82e7))

##### Ui

* Fix typo ([575514](https://github.com/fedesoriadev/laravel-blog-app/commit/57551494c491ebb3e7ca1d956d8bfa2ae9d2dfce))

##### Users

* Hash password when saving on admin users form ([1056fd](https://github.com/fedesoriadev/laravel-blog-app/commit/1056fda4a245292014444ab67dfd0503d2b2a733))


---

## [1.0.0](https://github.com/fedesoriadev/laravel-blog-app/compare/0398643ff7f2c991ab7de61c85747a5629cd16a4...v1.0.0) (2022-04-28)
### Features


##### Admin

* Add admin section index ([680fd9](https://github.com/fedesoriadev/laravel-blog-app/commit/680fd9d5b156a28e3824491219497a370b1171a5))
* Add confirmation buttons ([e13d1e](https://github.com/fedesoriadev/laravel-blog-app/commit/e13d1e0b99100caf159ed4d7b09ac9f0d00477d5))
* Add dropdown and menu mobile to admin section ([db75f0](https://github.com/fedesoriadev/laravel-blog-app/commit/db75f0e2962a574fa2cf552299d9d598bc6c1c09))
* Admin dashboard ([75ac8a](https://github.com/fedesoriadev/laravel-blog-app/commit/75ac8aeed2375302559b1f30977e2b870554b14a))
* Create AdminLayout and place initial design ([d4278a](https://github.com/fedesoriadev/laravel-blog-app/commit/d4278a8f5edf2a97f1e491d5abcb62688ec4b7c5))
* First draft of admin dashboard ([085b3f](https://github.com/fedesoriadev/laravel-blog-app/commit/085b3f8ae52d6ac2493eb95007bf34fbebf53fbc))
* Move header to slot component ([ecd3cb](https://github.com/fedesoriadev/laravel-blog-app/commit/ecd3cbe6a4ab17bd4b41693aae86d4c8339e1508))
* Provide visual feedback upon controller actions ([b0a829](https://github.com/fedesoriadev/laravel-blog-app/commit/b0a829b27fc31b72c7d2015ad05992a34c3f7750))
* Resolve LoginResponse upon user role ([ac0a83](https://github.com/fedesoriadev/laravel-blog-app/commit/ac0a83842a6b01bf558df36e1bfffe3d774b4ed9))

##### Auth

* Add email verification protection ([4f0267](https://github.com/fedesoriadev/laravel-blog-app/commit/4f026725ba79c2b914b0f4f4a3c94421635f0433))
* Complete authentication flow ([310f52](https://github.com/fedesoriadev/laravel-blog-app/commit/310f52812828ad0c9ed162566a35e9d518c1a205))

##### Authors

* Add route and controller to show posts of an author & add username to users ([9abde0](https://github.com/fedesoriadev/laravel-blog-app/commit/9abde0eb1003271ac0185f10d0db38b3ebae7afe))
* Add view for author page ([d01cbe](https://github.com/fedesoriadev/laravel-blog-app/commit/d01cbef240975e0bf9b12194e936eb503792d43c))

##### Comments

* Add comment list and form inside single post ([a9fb72](https://github.com/fedesoriadev/laravel-blog-app/commit/a9fb72654f9b18c7bd02ef812abc4214f8a588a9))
* Add list of comments to admin section ([86efc1](https://github.com/fedesoriadev/laravel-blog-app/commit/86efc13b7bf99d9e2ffe7d1cbe9f0890f56731e6))
* Add relationship between comments, posts and users (author) ([0caa77](https://github.com/fedesoriadev/laravel-blog-app/commit/0caa774c323228c87369e7a5f629f5d5f949d72b))
* Add route and controller for manage comments ([f06d8a](https://github.com/fedesoriadev/laravel-blog-app/commit/f06d8ac9a0c532c06ad80d0465a563fc41e634d4))
* Create comment model and migration ([90a160](https://github.com/fedesoriadev/laravel-blog-app/commit/90a1606676cf3dccf6115c1b65fcdb918ac5b616))

##### Core

* Add checkbox component ([e7423b](https://github.com/fedesoriadev/laravel-blog-app/commit/e7423b1a87f9156f348bfcbeebe88c933b8b6568))
* Add Fortify scaffolding and authentication views and components ([48eda1](https://github.com/fedesoriadev/laravel-blog-app/commit/48eda1a88b84b1e0b2f9471b1bd22b40ef2ddb36))
* Add language support ([103d8a](https://github.com/fedesoriadev/laravel-blog-app/commit/103d8aac22d3178eba4a65ca7065fd8a5f72fb9d))
* Add metatags ([490806](https://github.com/fedesoriadev/laravel-blog-app/commit/490806f85b5f66b6674d76b2c3de1d9571c3a508))

##### Posts

* Add form to create and edit posts ([915d4c](https://github.com/fedesoriadev/laravel-blog-app/commit/915d4cb8c33fd4556500a03577e7d2ac6439b54c))
* Add list of post to admin section ([bcd393](https://github.com/fedesoriadev/laravel-blog-app/commit/bcd393d7ecaa07ffec7d573db9d5330f32c02257))
* Add methods for create and update posts ([8bfd67](https://github.com/fedesoriadev/laravel-blog-app/commit/8bfd679e021c4cbd129f61b88567fa5ae655a6cd))
* Add post policy for admins and editors ([614ad4](https://github.com/fedesoriadev/laravel-blog-app/commit/614ad47e13d3885fe079d3b3b8860d3328515e9a))
* Add published scope & post controller ([9a1ff3](https://github.com/fedesoriadev/laravel-blog-app/commit/9a1ff3f1609082234aaee1eec0f039de3197e23d))
* Add relationship between posts and tags ([751378](https://github.com/fedesoriadev/laravel-blog-app/commit/75137861eb8557202386322040f556f275f52542))
* Add relationship between posts and users (author) ([6bbec3](https://github.com/fedesoriadev/laravel-blog-app/commit/6bbec3be0c9e5ba31aa433d0296b861fdfbedd64))
* Add route and controller method to show a single post if it is published ([b9fc36](https://github.com/fedesoriadev/laravel-blog-app/commit/b9fc36cc1fe2028e10c18a927c52611ee4c771e5))
* Add routes to publish and archive posts ([ce8711](https://github.com/fedesoriadev/laravel-blog-app/commit/ce87110e2d72a879e6328a1b97a4bb248c5aecf3))
* Add search posts by title or body ([2c360f](https://github.com/fedesoriadev/laravel-blog-app/commit/2c360f75eaeaf52bf55677dc4e1e6d5f564695e6))
* Add view for homepage (list of posts) and post component ([588521](https://github.com/fedesoriadev/laravel-blog-app/commit/588521a2e8f575edd2c98ac9c3a83c67e3afb074))
* Admin filter posts by status ([bb3a2f](https://github.com/fedesoriadev/laravel-blog-app/commit/bb3a2f7b08ed87da09e68f1a5b493cf98a3ad4c4))
* A post can be deleted ([6b1664](https://github.com/fedesoriadev/laravel-blog-app/commit/6b1664a1a7515ae926d4b82bb307b4c1e43a0c87))
* A user can create a post ([1acb94](https://github.com/fedesoriadev/laravel-blog-app/commit/1acb94f63a05bed6c250348307e5932e92b5a0e3))
* Create post model and migration ([e990c6](https://github.com/fedesoriadev/laravel-blog-app/commit/e990c6557d1ded4d8871a689851242303742e238))
* Disallow authors to create posts by another user ([7b949b](https://github.com/fedesoriadev/laravel-blog-app/commit/7b949b6f540d2f68edc3baee215620ccb736d9e3))
* Editors only see their posts ([8e4e16](https://github.com/fedesoriadev/laravel-blog-app/commit/8e4e1667bbde1bc8e1e9970f9636f98157e13ae6))
* Form to create and edit posts ([b835b8](https://github.com/fedesoriadev/laravel-blog-app/commit/b835b898bd1063b7bdf8841364cfaefe733de3b5))
* Post statuses on index page ([7afc5a](https://github.com/fedesoriadev/laravel-blog-app/commit/7afc5a2b342bb9dba1f855a9c58f08b8c4497255))
* Show a post view ([603045](https://github.com/fedesoriadev/laravel-blog-app/commit/603045ad5da202c97b72c5b157788498ec95a634))
* Sync tags when saving a post ([595d75](https://github.com/fedesoriadev/laravel-blog-app/commit/595d75f1079e5018ef748c38ed502a3942f2bb3f))

##### Roles

* Add relationship between roles and users ([425eeb](https://github.com/fedesoriadev/laravel-blog-app/commit/425eeb7004a2fb4b7d34f12ddf034a3cdacd50fb))
* Add, remove and check user roles ([6e68e4](https://github.com/fedesoriadev/laravel-blog-app/commit/6e68e4458fe43eb317f1168194dffb02d336d917))
* Create enum UserRole and Arrayable interface ([5571fa](https://github.com/fedesoriadev/laravel-blog-app/commit/5571fade67c5e3c1238f84f4f2d0d546517af8ff))
* Create role model and migration ([46f9fb](https://github.com/fedesoriadev/laravel-blog-app/commit/46f9fb0d65e3c76d673dc0437099bc86347f64e7))

##### Tags

* Add route and controller to show a tag posts ([d631d6](https://github.com/fedesoriadev/laravel-blog-app/commit/d631d63b2e3344235a8dacb2a89d7ee3aa28f06e))
* Add view for tag page ([2d01b9](https://github.com/fedesoriadev/laravel-blog-app/commit/2d01b94795b7310b901dfd0125d30fe2926b4bce))
* Create tag model and migration ([31b3e2](https://github.com/fedesoriadev/laravel-blog-app/commit/31b3e240935189b7c74faca9cb067aff82796155))

##### Ui

* Add alert component ([d5c176](https://github.com/fedesoriadev/laravel-blog-app/commit/d5c1765cb8708c89106a1c1a4d8bf58091dc8e6a))
* Add global layout component ([a02b1a](https://github.com/fedesoriadev/laravel-blog-app/commit/a02b1af9e4578d991fb504b1a43bcb71d0146477))
* Add spatie/laravel-flash package to show messages along with alert component ([2753cc](https://github.com/fedesoriadev/laravel-blog-app/commit/2753cc16938738e2b6d1f692fe1918db2f1966e8))
* Link component ([5ef5b9](https://github.com/fedesoriadev/laravel-blog-app/commit/5ef5b92544ebaba5a9ae5bee8b4fe45fcdce446e))

##### Users

* Add button in admin to resend verification email ([405f78](https://github.com/fedesoriadev/laravel-blog-app/commit/405f78c4b0abeb07de890b888fcee4c800d1e91d))
* Add list of users to admin section ([a0158a](https://github.com/fedesoriadev/laravel-blog-app/commit/a0158ae3d2c718915b8e724d0d4cf1e6760ac2b5))
* Add profile info to users ([fe1754](https://github.com/fedesoriadev/laravel-blog-app/commit/fe1754e67f77dc931effe0dbed0a4d6031c7e80c))
* Add profile section ([cd6de2](https://github.com/fedesoriadev/laravel-blog-app/commit/cd6de2e64deb5a099b837bc24c3547de4db34bb6))
* Add role field to user form ([8249c5](https://github.com/fedesoriadev/laravel-blog-app/commit/8249c5c394d6ede18ec3a02e1b31cc52f615cbf3))
* Add routes and controller for manage users ([f30acc](https://github.com/fedesoriadev/laravel-blog-app/commit/f30acc1e0cf09fd638a6c881aa97d537ca0aecdb))
* Add sizes to user avatar component ([ad88ea](https://github.com/fedesoriadev/laravel-blog-app/commit/ad88ea293cb345e799dab4c35515b328042129c7))
* Admin filter users by role ([556a3e](https://github.com/fedesoriadev/laravel-blog-app/commit/556a3e72a8f30a2d148c7a9daccaf2c41d3fc6b6))
* Form to create and update users ([c768a4](https://github.com/fedesoriadev/laravel-blog-app/commit/c768a4608e30e5c2f71720f11c11dee5579ff64c))

### Bug Fixes


##### Auth

* Fix home link of each role user ([a80293](https://github.com/fedesoriadev/laravel-blog-app/commit/a80293d7be824787cbbc2a95e241267b3b6ece4c))

##### Comments

* Fix redirection after comment was created ([dc7a29](https://github.com/fedesoriadev/laravel-blog-app/commit/dc7a29f9b0d5c630859d609416a65bf5f6eeefa8))
* Show comments in descending order & eager load comment authors ([f9e9b5](https://github.com/fedesoriadev/laravel-blog-app/commit/f9e9b5c2ada4738813723da53aa3edd84e7b0dfd))

##### Core

* Fix missing translation for pagination ([21b3a2](https://github.com/fedesoriadev/laravel-blog-app/commit/21b3a2f6ec1d49ca29f5e0cc581246e9a5ce24f0))
* Fix return type declaration in Language Middleware ([310cdf](https://github.com/fedesoriadev/laravel-blog-app/commit/310cdfa6a4c342f3bae4731c4ee15377df0f4263))

##### Posts

* Fix cover_image accessor when null ([686cd5](https://github.com/fedesoriadev/laravel-blog-app/commit/686cd5bcc337a1ee7e33db3e0204820740822e8c))
* Fix n+1 queries on tag and author show page ([b56cf9](https://github.com/fedesoriadev/laravel-blog-app/commit/b56cf98c6550559a22f898bf1c6398f0e5bb0e93))
* Fix null state when create post ([464996](https://github.com/fedesoriadev/laravel-blog-app/commit/464996aa16b952dc65b5655583dabcfdf6f9cbc3))
* Fix ommited admin posts index ([f4d0cd](https://github.com/fedesoriadev/laravel-blog-app/commit/f4d0cd1d136e02dad9f8f7ae4bb24102ec6e9a85))
* Fix unset post status when create ([437d5e](https://github.com/fedesoriadev/laravel-blog-app/commit/437d5e7057d98ea3c7f851301eb0b01f1b40a2d2))
* Fix user scope withRole for dynamic role argument ([69a9cf](https://github.com/fedesoriadev/laravel-blog-app/commit/69a9cf234d002522f724cee2eefb76208ea898fc))
* Show recent posts first in homepage ([79c3ab](https://github.com/fedesoriadev/laravel-blog-app/commit/79c3ab956436d586b30119e86e3d7f9c812d82e7))

##### Ui

* Fix typo ([575514](https://github.com/fedesoriadev/laravel-blog-app/commit/57551494c491ebb3e7ca1d956d8bfa2ae9d2dfce))

##### Users

* Hash password when saving on admin users form ([1056fd](https://github.com/fedesoriadev/laravel-blog-app/commit/1056fda4a245292014444ab67dfd0503d2b2a733))


---

