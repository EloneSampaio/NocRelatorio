<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Radios
 *
 * @ORM\Table(name="radios")
 * @ORM\Entity
 */
class Radios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="canal", type="string", length=45, nullable=true)
     */
    private $canal;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="string", length=45, nullable=true)
     */
    private $obs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;


}
