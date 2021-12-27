<?php

namespace EasyFeishu\Contact;
use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;
class ContactGroup extends AbstractAPI
{
    const API_POST_CONTACT_GROUP = 'https://open.feishu.cn/open-apis/contact/v3/group';
    const API_PATCH_CONTACT_GROUP = 'https://open.feishu.cn/open-apis/contact/v3/group/';
    const API_DELETE_CONTACT_GROUP = 'https://open.feishu.cn/open-apis/contact/v3/group/';
    const API_GET_CONTACT_GROUP = 'https://open.feishu.cn/open-apis/contact/v3/group/';
    const API_GET_CONTACT_GROUP_SIMPLELIST = 'https://open.feishu.cn/open-apis/contact/v3/group/simplelist';

    /**
     * 创建用户组
     *
     * @param array $params 请求体
     *  @param array $query  查询参数
     *
     * @return Collection
     */
    public function createGROUP(array $params, array $query){
        return $this->parseJSON('post', [
            self::API_POST_CONTACT_GROUP.http_build_query($query),
            $params
        ]);
    }
}
