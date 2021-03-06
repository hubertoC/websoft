<?php

namespace HZ\Wonja237Bundle\Repository;
use Doctrine\ORM\Query\Expr\Join;
/**
 * ArtisteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArtisteRepository extends \Doctrine\ORM\EntityRepository
{

   public function byCategory($category){

     $qb = $this->createQueryBuilder('a');

                $qb
                ->innerJoin('a.categories','c')
                ->addSelect('c');

                $qb->where($qb->expr()->in('c.id', $category));

            return $qb->getQuery()->getResult();
  }

  public function recherche($chaine)
  {
    $qb=$this->createQueryBuilder('A')
             ->select('A')
             ->where('A.name like :chaine')
             ->orderBy('A.id')
             ->setParameter('chaine' ,$chaine);
             return $qb->getQuery()->getResult();
  }

  public function findEntitiesByString($str){
          return $this->getEntityManager()
              ->createQuery(
                  'SELECT e
                  FROM HZWonja237Bundle:Artiste e
                  WHERE e.name LIKE :str OR e.surname LIKE :str'
              )
              ->setParameter('str', '%'.$str.'%')
              ->getResult();
      }

      public function getArtisteAvecCommentaires()
    {
      $qb = $this->createQueryBuilder('a')
                 ->leftJoin('a.commentaire', 'c')
                 ->addSelect('c');
                 
      return $qb->getQuery()
                ->getResult();
    }



}
