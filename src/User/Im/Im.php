<?php

namespace EasyFeishu\User\Im;

use EasyFeishu\Core\AbstractAPI;
use EasyFeishu\Utils\File;
use Mayunfeng\Supports\Collection;

class Im extends AbstractAPI
{
    const API_DELETE_MESSAGES = 'https://open.feishu.cn/open-apis/im/v1/messages/';

    /**
     * 用户撤回消息.
     *
     * @param string $messageId 消息id
     *
     * @return Collection
     */
    public function delMessage($messageId): Collection
    {
        return $this->parseJSON('delete', [
            self::API_DELETE_MESSAGES.$messageId,
        ]);
    }

}
