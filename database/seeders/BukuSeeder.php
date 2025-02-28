<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'judul' => 'China: Warisan Klasik dan Daya Dinamis yang Menggetarkan Dunia',
                'penulis' => 'Jusra Chandra',
                'penerbit' => 'Penerbit Buku Kompas',
                'deskripsi' => 'Tidak hanya Jepang ataupun Amerika Serikat, ada banyak orang yang sangat penasaran dengan rahasia kesuksesan bangsa Tiongkok. Perlahan namun pasti, Tiongkok mulai tumbuh menjadi raksasa dunia yang siap menggeser negara adidaya lain. Tapi banyak yang mengatakan bahwa kebangkitan Tiongkok tersebut berhubungan dengan alam pemikiran dan juga peradabannya yang maju dan murni. Buku yang satu ini juga dapat dijadikan sebagai pedoman untuk Anda yang ingin memperkaya wawasan dan pengetahuan mengenai pemikiran bangsa Tiongkok. Siapa tahu Anda bisa ketularan sukses dengan belajar mengenai tradisi, budaya, dan juga cara mereka dalam menghadapi polemik.',
                'tahun_terbit' => '2019',
                'kode' => 'B0001',
                'stok' => '100',
                'cover' => 'https://ebooks.gramedia.com/ebook-covers/50303/image_highres/ID_WKDD2020MTH01KD.jpg',
            ],
            [
                'judul' => 'Sejarah Dunia yang Disembunyikan',
                'penulis' => 'Jonathan Black',
                'penerbit' => 'Penerbit Buku Kompas',
                'deskripsi' => 'Di halaman pencarian Google, ada banyak orang yang mencari kata kunci “Sejarah Dunia yang Disembunyikan”. Memang ada kalanya, berbagai hal yang bersifat kontroversial lebih diminati dibandingkan dengan beberapa hal yang sifatnya datar. Akan tetapi, buku sejarah dunia ini sukses menarik perhatian dunia karena satu alasan saja. Dimana buku ini secara tegas membocorkan beberapa misteri dunia yang tidak pernah diungkap sebelumnya. Oleh karena itu, wajar saja jika buku yang satu ini memiliki banyak penggemar. Tapi, apabila kita mengesampingkan misterinya, buku ini dapat dijadikan sebagai pilihan untuk Anda yang ingin memahami dan juga mengkritisi sejarah dunia. Jika Anda mencari pilihan lain mengenai buku sejarah dunia, maka buku ini sangat cocok untuk dipilih.',
                'tahun_terbit' => '2019',
                'kode' => 'B0002',
                'stok' => '100',
                'cover' => 'http://opac.iainpalopo.ac.id:2200/lib/minigalnano/createthumb.php?filename=images/docs/cover_sejarah-dunia-yang-disembunyikan-the-secret-of-the-world-20221207091213.jpg&width=200',
            ],
            [
                'judul' => 'Sejarah Teh - Asal Usul dan Perkembangan Minuman Favorit Dunia',
                'penulis' => 'Laura C. Martin',
                'penerbit' => 'Penerbit Buku Kompas',
                'deskripsi' => 'Walaupun sering mengonsumsinya, masih ada banyak orang yang tidak mengetahui sejarah teh itu sendiri. Buku dengan judul asli “A History of Tea” ini menjelaskan mengenai asal-usul, tradisi, hingga penyebaran teh di dunia. Untuk Anda yang mengaku pecinta teh, bisa mempertimbangkan untuk membaca buku ini. Melalui buku ini, Anda akan mengetahui tradisi minum teh di kedai Tiongkok hingga kuil di Jepang. Selain itu, Anda juga bisa menguak informasi bahwa setiap bangsa mempunyai tradisi minum teh dan juga cara pengelolaan yang berbeda.',
                'tahun_terbit' => '2019',
                'kode' => 'B0003',
                'stok' => '100',
                'cover' => 'https://bukukita.com/babacms/displaybuku/114291_f.jpg',
            ],
            [
                'judul' => 'Sejarah Lengkap Perang Dunia 1',
                'penulis' => 'Alfi Arifian',
                'penerbit' => 'Penerbit Buku Kompas',
                'deskripsi' => 'Perang Dunia 1 merupakan sebuah kontes gladiator yang paling besar sepanjang sejarah umat manusia. Dimana perang tersebut melibatkan para hegemoni Eropa dan juga koloninya. Vladimir Lenin sebagai salah satu tokoh komunis dari Rusia yang diberi julukan sebagai “Virus” oleh para hegemoni Eropa ini mengatakan bahwa Perang Dunia 1 ini merupakan perang bangsawan, bukan perang rakyat.',
                'tahun_terbit' => '2019',
                'kode' => 'B0004',
                'stok' => '100',
                'cover' => 'https://image.gramedia.net/rs:fit:0:0/plain/https://cdn.gramedia.com/uploads/items/sejarah_UuXRFLd.jpg',
            ],
            [
                'judul' => 'Dunia Kuno Empat Benua',
                'penulis' => 'Anisa Septianingrum',
                'penerbit' => 'Penerbit Buku Kompas',
                'deskripsi' => 'Negara-negara yang ada di Eropa mempunyai tradisi yang dilaksanakan setiap bulan Oktober, yakni Halloween. Di balik tradisi ini, ternyata mempunyai hubungan dengan kebiasaan masyarakat di masa lalu. Orang-orang yang membuat menjadi bentuk muka hantu pada saat acara Halloween merupakan bangsa Kelt. Mereka telah membuat labu itu menjadi ikon dari Halloween. Hal ini merupakan salah satu dari kebudayaan bangsa Eropa. Dengan memahami kebudayaan tersebut, tentu akan membuat kita tidak melulu fokus dengan Kuil Athena yang ada pada masa perang Sparta-Persia, atau dengan keagungan Romawi saja. Tidak hanya Eropa, dunia mempunyai benua lain seperti Afrika, Asia, dan juga Amerika yang mempunyai sejarah serta kebudayaan kunonya masing-masing yang mana tidak dapat ditinggalkan dari materi sejarah.',
                'tahun_terbit' => '2019',
                'kode' => 'B0005',
                'stok' => '100',
                'cover' => 'https://image.gramedia.net/rs:fit:0:0/plain/https://cdn.gramedia.com/uploads/items/9786237210214_Sejarah-Ringkas-Terbaik-Dunia-Kuno-Empat-Benua.jpg',
            ],
        ];

        Buku::insert($data);
    }
}
