<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Entity/Destination.php';
require_once __DIR__ . '/../src/Entity/Quote.php';
require_once __DIR__ . '/../src/Entity/Site.php';
require_once __DIR__ . '/../src/Entity/Template.php';
require_once __DIR__ . '/../src/Entity/User.php';
require_once __DIR__ . '/../src/Helper/SingletonTrait.php';
require_once __DIR__ . '/../src/Context/ApplicationContext.php';
require_once __DIR__ . '/../src/Repository/Repository.php';
require_once __DIR__ . '/../src/Repository/DestinationRepository.php';
require_once __DIR__ . '/../src/Repository/QuoteRepository.php';
require_once __DIR__ . '/../src/Repository/SiteRepository.php';
require_once __DIR__ . '/../src/TemplateManager.php';

class TemplateManagerTest extends TestCase
{
    /**
     * @test
     */
    public function test()
    {
        $faker = \Faker\Factory::create();
        $randonNum = $faker->randomNumber();

        $expectedDestination = DestinationRepository::getInstance()->getById($randonNum);
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();

        $quote = new Quote($randonNum, $randonNum, $randonNum, $faker->date());

        $templateText = "
        Bonjour " . $expectedUser->firstname . ",
        
        Merci d'avoir contacté un agent local pour votre voyage " . $expectedDestination->countryName . ".
        
        Bien cordialement,
        
        L'équipe Evaneos.com
        www.evaneos.com
        ";

        $template = new Template(
            1,
            'Votre voyage avec une agence locale [quote:destination_name]',
            $templateText
        );
        $templateManager = new TemplateManager();

        $message = $templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote
            ]
        );

        $this->assertEquals('Votre voyage avec une agence locale ' . $expectedDestination->countryName, $message->subject);
        $this->assertEquals($templateText, $message->content);
    }
}
