<?php

declare(strict_types=1);

namespace Waller\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {

    }
}

//namespace AppBundle\Entity;
//
//use Symfony\Component\Security\Core\User\UserInterface;
//use Symfony\Component\Validator\Constraints as Assert;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Table(name="user")
// * @ORM\Entity
// */
//class User implements UserInterface
//{
//    /**
//     * @ORM\Column(type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    private $id;
//
//    /**
//     * @ORM\Column(type="string", length=255, unique=true)
//     * @Assert\NotBlank()
//     */
//    private $username;
//
//    /**
//     * @Assert\NotBlank()
//     * @Assert\Length(max=4096)
//     */
//    private $plainPassword;
//
//    /**
//     * @return mixed
//     */
//    public function getPlainPassword()
//    {
//        return $this->plainPassword;
//    }
//
//    /**
//     * @param mixed $plainPassword
//     */
//    public function setPlainPassword($plainPassword)
//    {
//        $this->plainPassword = $plainPassword;
//    }
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $password;
//
//    /**
//     * @ORM\Column(type="string", length=255, unique=true)
//     * @Assert\NotBlank()
//     * @Assert\Email()
//     */
//    private $email;
//
//    /**
//     * @return mixed
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
//
//    /**
//     * @param mixed $email
//     */
//    public function setEmail($email)
//    {
//        $this->email = $email;
//    }
//
//    public function __construct(string $username, string $password)
//    {
//        $this->username = $username;
//        $this->password = $password;
//    }
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//    public function getUsername()
//    {
//        return $this->username;
//    }
//
//    public function getPassword(): string
//    {
//        return $this->password;
//    }
//
//    public function eraseCredentials()
//    {
//
//    }
//
//    public function getRoles(): array
//    {
//        return ['ROLE_USER'];
//    }
//
//    public function getSalt()
//    {
//        return null;
//    }
//}