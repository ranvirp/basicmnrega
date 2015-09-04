<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class ComplaintCreatePage extends BasePage
{
    public $route = '/complaint/complaint/create';

    /**
     * @param string $username
     * @param string $password
     */
    public function create($name, $fname,$mobileno,$source,$manualno,$address,$jobcardno,$complainttype,
     $complaintsubtype,$description,$district,$block,$panchayat,$actiontype,$markofficerdesignation,
     $markofficerothers,$deadline,$actiontype)
    {
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
