# PHP SDK for XMLY Services

## Features

- 点播 API
  - 免费内容 API
    - [x] 分类列表: aodManager->getCategoriesList() 
    - [x] 标签列表: aodManager->getTagsList() 
    - [x] 专辑列表: aodManager->getAlbumsList() 
    - [x] 获取专辑下的声音列表: aodManager->getAlbumsBrowse() 
    - [x] 批量获取专辑信息: aodManager->getAlbumsGetBatch()
    
  - 主播相关 API
    - [x] 获取主播分类列表: aodManager->getAnnouncersCategories()
  
## Demo

- 点播 API
  - 免费内容 API
    - [分类列表](https://github.com/timhbw/xmly-php-sdk/blob/main/examples/AOD/get_free_categories_list.php) 
    - [标签列表](https://github.com/timhbw/xmly-php-sdk/blob/main/examples/AOD/get_free_tags_list.php) 
    - [专辑列表](https://github.com/timhbw/xmly-php-sdk/blob/main/examples/AOD/get_free_albums_list.php) 
    - [获取专辑下的声音列表](https://github.com/timhbw/xmly-php-sdk/blob/main/examples/AOD/get_free_albums_browse.php) 
    - [批量获取专辑信息](https://github.com/timhbw/xmly-php-sdk/blob/main/examples/AOD/get_free_albums_get_batch.php)
  - 主播相关 API
    - [获取主播分类列表](https://github.com/timhbw/xmly-php-sdk/blob/main/examples/AOD/get_announcers_categories.php)
