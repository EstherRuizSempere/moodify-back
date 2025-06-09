<?php

class Emotion
{
    private int $id;
    private int $user_id;
    private string $fecha;
    private string $emotion;
    private string $comments;

    /**
     * @param int $id
     * @param int $user_id
     * @param string $fecha
     * @param string $emotion
     * @param string $comments
     */
    public function __construct(int $id, int $user_id, string $fecha, string $emotion, string $comments)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->fecha = $fecha;
        $this->emotion = $emotion;
        $this->comments = $comments;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getEmotion(): string
    {
        return $this->emotion;
    }

    public function setEmotion(string $emotion): void
    {
        $this->emotion = $emotion;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'fecha' => $this->getFecha(),
            'emotion' => $this->getEmotion(),
            'comments' => $this->getComments()
        ];
    }

}


