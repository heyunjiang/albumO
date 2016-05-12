module.exports = function (grunt) {


    grunt.initConfig({

        sass: {
            dist: {
                options: {
                    sourcemap: 'none'
                },
                files: {
                    'Public/admin/style.css': 'Public/admin/style.scss',
                    'Public/home/style.css': 'Public/home/style.scss'
                }
            }
        },
        watch: {
            scripts: {
                files: [
                    'Public/admin/style.scss',
                    'Public/home/style.scss',
                    'Public/home/bigPic.scss'
                ],
                tasks: ['sass']
            }
        }
    });


    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('default', ['watch']);

};