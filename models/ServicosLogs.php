<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ServicosLogs
 *
 * @ORM\Table(name="servicos_logs")
 * @ORM\Entity
 */
class ServicosLogs
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="servicos", type="string", length=30, nullable=false)
     */
    private $servicos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="time", nullable=false)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fim", type="time", nullable=false)
     */
    private $fim;

    /**
     * @var string
     *
     * @ORM\Column(name="intervencao_causa", type="text", nullable=true)
     */
    private $intervencaoCausa;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=false)
     */
    private $obs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_usuario", type="boolean", nullable=false)
     */
    private $idUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;


}
