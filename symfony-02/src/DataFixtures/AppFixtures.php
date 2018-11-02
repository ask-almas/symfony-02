<?php
/**
 * Created by PhpStorm.
 * User: asus)
 * Date: 01.11.2018
 * Time: 18:33
 */

namespace App\DataFixtures;


use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager){
        $this->loadMicroPosts($manager);
        $this->loadUsers($manager);
    }

    private function loadMicroPosts(ObjectManager $manager){
        for ($i=0; $i<10; $i++){
            $microPost = new MicroPost();
            $microPost->setText("Some random text: " . rand(0, 100));
            $microPost->setTime(new \DateTime('2018-11-01'));
            $manager->persist($microPost);
        }

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager){
        $user = new User();
        $user->setUsername('symfony_user');
        $user->setFullName('Symfony User');
        $user->setEmail('symfony_user@example.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'symfony_password'));

        $manager->persist($user);
        $manager->flush();
    }
}