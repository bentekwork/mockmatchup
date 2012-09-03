<?php
// src/Acme/UserBundle/Entity/User.php
namespace Mock\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Mock\UserBundle\Entity\User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Mock\UserBundle\Entity\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $username;
	
    /**
     * @ORM\Column(type="text")
     */
    private $guid;

    /**
     * @ORM\Column(type="text")
     */
    private $salt;

    /**
     * @ORM\Column(type="text")
     */
    private $password;

    /**
     * @ORM\Column(type="text")
     */
    private $access_token;

    /**
     * @ORM\Column(type="text")
     */
    private $access_token_secret;

    /**
     * @ORM\Column(type="text")
     */
    private $verifier;

    /**
     * @ORM\Column(type="text")
     */
    private $oauth_session_handle;
    
	/**
     * @ORM\Column(type="text", nullable="true")
     */
	public $league;

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @inheritDoc
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @inheritDoc
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function equals(UserInterface $user)
    {
        return $this->username === $user->getUsername();
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Set access_token
     *
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;
    }

    /**
     * Get access_token
     *
     * @return string 
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Set access_token_secret
     *
     * @param string $accessTokenSecret
     */
    public function setAccessTokenSecret($accessTokenSecret)
    {
        $this->access_token_secret = $accessTokenSecret;
    }

    /**
     * Get access_token_secret
     *
     * @return string 
     */
    public function getAccessTokenSecret()
    {
        return $this->access_token_secret;
    }

    /**
     * Set verifier
     *
     * @param string $verifier
     */
    public function setVerifier($verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * Get verifier
     *
     * @return string 
     */
    public function getVerifier()
    {
        return $this->verifier;
    }

    /**
     * Set oauth_session_handle
     *
     * @param string $oauthSessionHandle
     */
    public function setOauthSessionHandle($oauthSessionHandle)
    {
        $this->oauth_session_handle = $oauthSessionHandle;
    }

    /**
     * Get oauth_session_handle
     *
     * @return string 
     */
    public function getOauthSessionHandle()
    {
        return $this->oauth_session_handle;
    }

}