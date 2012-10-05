<?php

namespace AllPlayers\Command;

use Guzzle\Tests\GuzzleTestCase;
use AllPlayers\Tests\User\Fixtures\RandomUser;

class GetUserTest extends GuzzleTestCase
{
    /**
     * @var object User
     */
    private $user;

    /**
     * Setting up get user test by creating the user first.
     */
    public function setUp()
    {
        $client = $this->getServiceBuilder()->get('admin.basic');
        $random_user = new RandomUser();
        $command = $client->getCommand('create_user', (array) $random_user);
        $this->user = $client->execute($command);
    }

    public function testGetUser()
    {
        $client = $this->getServiceBuilder()->get('admin.basic');
        $command = $client->getCommand('get_user', array('uuid' => $this->user->uuid));
        //$this->setMockResponse($client, 'UserResponse');
        $user_retrieved = $client->execute($command);
        $this->assertEquals($user_retrieved, $this->user);
    }
}