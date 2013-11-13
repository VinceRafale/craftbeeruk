<?php

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use FOS\CommentBundle\Document\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @MongoDB\Document(collection="comments")
 * @MongoDB\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment implements SignedCommentInterface
{

    /** @MongoDB\Id */
    protected $id;

    /** @MongoDB\ReferenceOne(targetDocument="Craft\LocationBundle\Document\Thread") */
    protected $thread;

    /** @MongoDB\ReferenceOne(targetDocument="Craft\UserBundle\Document\User") */
    protected $author;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param UserInterface $author
     * @return Comment
     */
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return Craft\UserBundle\Document\User $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function getAuthorName()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }

        return $this->getAuthor()->getUsername();
    }

    /**
     * Set rating
     *
     * @param int $rating
     * @return Comment
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Get rating
     *
     * @return int $rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set created
     *
     * @param date $created
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return date $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add foundHelpful
     *
     * @param Craft\UserBundle\Document\User $foundHelpful
     */
    public function addFoundHelpful(\Craft\UserBundle\Document\User $foundHelpful)
    {
        $this->foundHelpful[] = $foundHelpful;
    }

    /**
     * Get foundHelpful
     *
     * @return Doctrine\Common\Collections\Collection $foundHelpful
     */
    public function getFoundHelpful()
    {
        return $this->foundHelpful;
    }

    /**
     * Remove foundHelpful
     *
     * @param <variableType$foundHelpful
     */
    public function removeFoundHelpful(\Craft\UserBundle\Document\User $foundHelpful)
    {
        $this->foundHelpful->removeElement($foundHelpful);
    }

    /**
     * Set thread
     *
     * @param \FOS\CommentBundle\Model\ThreadInterface $thread
     * @return self
     */
    public function setThread(\FOS\CommentBundle\Model\ThreadInterface $thread)
    {
        $this->thread = $thread;
        return $this;
    }

    /**
     * Get thread
     *
     * @return Craft\LocationBundle\Document\Thread $thread
     */
    public function getThread()
    {
        return $this->thread;
    }
}
