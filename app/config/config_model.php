<?php
/**
 * 管理员的权限配置文件
 */
global $config_model;

$config_model=array(
'convert.cache.config'=>WWW_ROOT."/xml/convert/memcached_client.xml",
'blocks.dao.config'=>WWW_ROOT."/xml/convert/gblock.xml",
'stocks.dao.config'=>WWW_ROOT."/xml/convert/gstock.xml",
'relation.dao.config'=>WWW_ROOT."/xml/convert/block_stock_relation.xml",
'history.dao.config'=>WWW_ROOT."/xml/convert/stock_history.xml",

//事件
'event.cache.config'=>WWW_ROOT."/xml/events/memcached_client.xml",
'news_dao.config'=>WWW_ROOT."/xml/events/news_dao.xml",
'tags_dao.config'=>WWW_ROOT."/xml/events/tags_dao.xml",
'newsTagsRelation_dao.config'=>WWW_ROOT."/xml/events/newsTagsRelation_dao.xml",
'termTaxonomyType_dao.config'=>WWW_ROOT."/xml/events/termTaxonomyType_dao.xml",
'topicsType_dao.config'=>WWW_ROOT."/xml/events/topicsType_dao.xml",
'topics_dao.config'=>WWW_ROOT."/xml/events/topics_dao.xml",

//政策
'policy.cache.config'=>WWW_ROOT."/xml/policy/memcached_client.xml",
'policy_dao.config'=>WWW_ROOT."/xml/policy/policy_dao.xml",
'tags_dao.config'=>WWW_ROOT."/xml/policy/tags_dao.xml",
'policyTagsRelation_dao.config'=>WWW_ROOT."/xml/policy/policyTagsRelation_dao.xml",
'termTaxonomyType_dao.config'=>WWW_ROOT."/xml/policy/termTaxonomyType_dao.xml",
);
