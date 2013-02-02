#!/bin/bash

#input parameters
enterprise_id=""
app_theme=""
app_version=""
app_name=""
app_branch=""

apk_dir="/var/www/server/apk"

build_app()
{
    #make temp directory for apk build
    build_dir=`mktemp -d --suffix .apkbuild`;

    #do update via git
    git checkout $app_branch && git pull

    \cp -a . $build_dir

    cd $build_dir

    #copy theme files
    cmd="\cp $app_theme/res/drawable* -fr ./res/"
    eval $cmd

    #generate build.xml
    android update project --name surf-platform -t 1 -p . 

    #replace version in source code
    sed -i "s/BUILD_VERSION\ =\ \"68\"/BUILD_VERSION\ =\ \"${app_version}\"/" src/com/surfing/setting/SettingActivity.java

    if [ -n "$app_name" ]; then
        sed -i "s/APP_PublicPlatform/$app_name/g" res/values/strings.xml
        sed -i "s/APP_PublicPlatform/$app_name/g" res/values-zh-rCN/strings.xml
    fi

    if [ $enterprise_id -ne "41" ]; then
        echo "remove assets/userinfo.xml"
        rm -frv assets/userinfo.xml
    fi

    #compile client
    ant release

    #dir and file name
    bin_dir="bin"
    unsigned_apk=`find $bin_dir -name *unsigned.apk`

    signed_apk="$app_name.apk"
    download_dir="$apk_dir/$enterprise_id"
    final_file="$app_version.apk"

    #sign apk
    echo 
    echo "====="
    echo "final file       :" $final_file
    echo "download_dir     :" $download_dir 
    echo "latest version   :" $app_version
    echo "client file name :" $signed_apk
    echo "====="
    echo 

    #move apk to target directory
    if [ ! -d $download_dir ]; then
        mkdir -p $download_dir
    fi

    cmd="jarsigner -verbose -keystore ShenTangTech -storepass linuxred -keypass linuxred -signedjar $signed_apk $unsigned_apk laworks"

    eval $cmd

    echo "Sign apk cmd:" $cmd

    \cp $signed_apk $download_dir/$final_file
    
    echo "File for download:" $download_dir/$final_file
    ls -lh "$download_dir/$final_file"
}

usage()
{
    echo "usage: build.sh -e|--enterprise <enter_id> -t|--theme <theme_dir> -v|--version <version_string> -b|--branch <branch_name> -n|--name <app_name>"
    exit 1
}

debug()
{
    echo "app name     :"$app_name
    echo "app theme    :"$app_theme
    echo "app branch   :"$app_branch
    echo "app version  :"$app_version
    echo "enterprise id:"$enterprise_id
}

parse_args()
{
    [ $# -eq 0 ] && usage
    ARGS=`getopt -a -o e:t:v:n:b:h -l enterprise:,theme:,version:,branch:,name:,help -- "$@"`
    [ $? -ne 0 ] && usage  
    eval set -- "${ARGS}"
    while true
    do
        case "$1" in
            -e|--enterprise)
                enterprise_id=$2
                shift
                ;;
            -t|--theme)
                app_theme=$2
                shift
                ;;
            -v|--version)
                app_version=$2
                shift
                ;;
            -b|--branch)
                app_branch=$2
                shift
                ;;
            -n|--name)
                app_name=$2
                shift
                ;;
            -h|--help)
                usage
                ;;
            --)
                shift
                break
                ;;
        esac
        shift
    done

}

verify_args()
{
    if [[ -z $app_name || -z $app_branch || -z $enterprise_id  || -z $app_theme || -z $app_version ]] 
    then
        usage
    fi

    app_theme=`readlink -f $app_theme`
    if [ ! -d $theme_dir ]; then
        echo "theme director: $app_theme does not exist"
        exit 1
    fi
}

main()
{
    parse_args $@
    verify_args
    debug
    
    #prepare for java and android related tools
    source /etc/profile

    build_app

    exit 0
}


#main 
main "$@"
