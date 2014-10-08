<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * InformacaoDiaria
 *
 * @ORM\Table(name="informacao_diaria")
 * @ORM\Entity
 */
class InformacaoDiaria
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
     * @ORM\Column(name="obs", type="string", length=45, nullable=false)
     */
    private $obs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;


}
