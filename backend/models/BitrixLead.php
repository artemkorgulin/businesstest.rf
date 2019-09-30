<?php
/**
 * Created by PhpStorm.
 * User: AAVolkov
 * Date: 21.02.2018
 * Time: 17:04
 */

namespace common\models;
use common\modules\organizations\common\models\Organization;
use yii\base\Component;
use yii\helpers\Url;

class BitrixLead extends Component
{
    public $partner  = null;
    public $land     = 'business-testing';
    public $unit     = 'dnifgmegacampus';
    public $url      = 'http://business.synergyonline.ru/';
    public $campaign = 'Предпринимательство 2018';
    public $referer  = 'http://business.synergyonline.ru/';

    public $name;
    public $email;
    public $phone;
    public $birthdate;

    public $comments;
    public $region;

    /**
     * Сборка лида из юзера
     * @param User $user
     * @return static
     */
    public static function compose(User $user)
    {
        $lead = new static();
        $lead->name  = trim($user->profile->name_l . ' ' . $user->profile->name_f . ' ' . $user->profile->name_m);
        $lead->email = $user->email;
        $lead->phone = $user->profile->phone;

        $org = $user->profile->school;
        $types = Organization::getTypeItems();
        $classes = $org->getClasses();

        $lead->partner  = $org->partner;
        $lead->comments = trim($org->name . ' (' . $types[$org->type_id] . ') // ' . $classes[$user->profile->class_id]). '<br/><br/><br/>'
            . '<a target="_blank" href="http://business.synergyonline.ru' . Url::to(['/site/result/', 'token' => $user->token_btest, 'id' => $user->id]). '">Распечатать результат</a><br/>'
            . '<a target="_blank" href="http://business.synergyonline.ru' . Url::to(['/site/cert/', 'token' => $user->token_btest, 'id' => $user->id]). '">Распечатать сертификат</a>';
        $lead->birthdate = $user->profile->b_date;

        $region = [];
        /** @var Region $reg */
        $reg = $org->getRegion();
        if ($p = $reg->parent) {
            if ($g = $p->parent) {
                $region[] = $g->name;
            }
            $region[] = $p->name;
        }
        $region[] = $reg->name;

        $lead->region = implode(' // ', $region);

        return $lead;
    }

    public function send($real = true)
    {
        if ($real) {
            $postData = [
                "unit"      => $this->unit,
                "land"      => $this->land,
                "url"       => $this->url,
                "name"      => $this->name,
                "email"     => $this->email,
                "phone"     => $this->phone,
                "comments"  => $this->comments,
                "campaign"  => $this->campaign,
                "region"    => $this->region,
                "partner"   => $this->partner,
            ];

            $bd = explode('-', $this->birthdate);

            if (3 === count($bd)) {
                $postData['birthdate'] = $bd[2] . '.' . $bd[1] . '.' . $bd[0];
            } else {

            }

            $get = http_build_query($postData);


            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://synergy.ru/lander/alm/lander.php?r=land/index&unit=dnifgmegacampus&partner=" . $this->partner . "&" . $get);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_REFERER, $this->referer);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            $response = curl_exec($curl);
            curl_close($curl);
        }
    }

}