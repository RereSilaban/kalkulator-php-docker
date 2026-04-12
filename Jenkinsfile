pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Mengambil kode dari folder...'
                // Karena file ada di D:, Jenkins akan otomatis baca folder tempat workspace-nya
            }
        }
        stage('Build Docker Image') {
            steps {
                bat 'docker build -t kalkulator-php-test .'
            }
        }
        stage('Deploy Container') {
            steps {
                // Hapus container lama kalau ada, biar gak error port-nya
                bat 'docker stop container-kalkulator || exit 0'
                bat 'docker rm container-kalkulator || exit 0'
                // Jalankan di port 9090
                bat 'docker run -d --name container-kalkulator -p 9090:80 kalkulator-rere'
            }
        }
    }
    post {
        always {
            echo 'Proses Selesai!'
        }
        failure {
            echo 'Build Gagal! Mengirim email...'
            // Di sini nanti email notifikasi akan otomatis terpicu
        }
    }
}