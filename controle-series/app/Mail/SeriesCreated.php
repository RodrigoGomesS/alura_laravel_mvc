<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;

    public string $nomeSerie;
    public int $idSerie;
    public int $qtdTemporadas;
    public int $episodiosPorTemporada;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $nomeSerie, int $idSerie, int $qtdTemporadas, int $episodiosPorTemporada)
    {
        $this->nomeSerie = $nomeSerie;
        $this->idSerie = $idSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->episodiosPorTemporada = $episodiosPorTemporada;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series-created');
    }
}
