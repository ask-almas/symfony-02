<?php
/**
 * Created by PhpStorm.
 * User: asus)
 * Date: 09.11.2018
 * Time: 17:39
 */

namespace App\EventListener;


use App\Entity\LikeNotification;
use App\Entity\MicroPost;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\PersistentCollection;

class LikeNotificationSubscriber implements EventSubscriber {

    public function getSubscribedEvents(){
        return [
            Events::onFlush
        ];
    }

    public function onFlush(OnFlushEventArgs $args){
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        /**
         * @var PersistentCollection $collectionUpdate
         */
        foreach ($uow->getScheduledCollectionUpdates() as $collectionUpdate){
            if(!$collectionUpdate->getOwner() instanceof MicroPost){
                continue;
            }

            if('likedBy' !== $collectionUpdate->getMapping()['fieldName']){
                continue;
            }

            $insrttDiff = $collectionUpdate->getInsertDiff();

            if(!count($insrttDiff)){
                return;
            }


            /** @var MicroPost $microPost */
            $microPost = $collectionUpdate->getOwner();

            $notification = new LikeNotification();
            $notification->setUser($microPost->getUser());
            $notification->setMicroPost($microPost);
            $notification->setLikedBy(reset($insrttDiff));

            $em->persist($notification);
            $uow->computeChangeSet(
                $em->getClassMetadata(LikeNotification::class),
                $notification
            );
        }
    }
}