<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class FileExported extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $filename;
    private $newName;
    public function __construct($filename, $newName)
    {
        $this->filename = $filename;
        $this->newName = $newName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@doanhuuhoa.com')
                    ->subject('Export dữ liệu thành công')
                    ->markdown('emails.file.exported')
                    ->attachFromStorage($this->filename, $this->newName);
    }
}
