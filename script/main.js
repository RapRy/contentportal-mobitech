$(() => {
  class Navigation {
    constructor() {
      this.toggleMobileMenu = false;
      this.duration = 400;
    }

    setToggleMobileMenu = () => {
      if (this.toggleMobileMenu) {
        $(".nav-mobile-container").animate(
          { top: "80%", opacity: 0 },
          this.duration
        );
        this.toggleMobileMenu = false;
        return;
      }

      if (!this.toggleMobileMenu) {
        $(".nav-mobile-container").animate(
          { top: 0, opacity: 1 },
          this.duration
        );
        this.toggleMobileMenu = true;
        return;
      }
    };

    events = () => {
      $(".burger-icon").on("click", this.setToggleMobileMenu);
      $(".nav-mobile-container i").on("click", this.setToggleMobileMenu);
    };
  }

  class SubNavigation {
    arrowNextClick = () => {
      const matrix = $(".subcategories").css("transform").split(",");

      if (matrix[4].includes("-")) {
        const prevValueX = parseInt(matrix[4].slice(2));

        $(".subcategories").css({
          transform: `translateX(-${prevValueX + 80}px)`,
        });
      } else {
        $(".subcategories").css({
          transform: `translateX(-80px)`,
        });
      }
    };

    arrowPrevClick = () => {
      const matrix = $(".subcategories").css("transform").split(",");
      const prevValueXPositive = parseInt(matrix[4]);

      if (matrix[4].includes("-")) {
        const prevValueX = parseInt(matrix[4].slice(2));

        if (Math.sign(prevValueX - 80) === -1) {
          $(".subcategories").css({
            transform: `translateX(0px)`,
          });

          return;
        }

        $(".subcategories").css({
          transform: `translateX(-${prevValueX - 80}px)`,
        });
      } else if (prevValueXPositive === 0) {
        return;
      } else {
        $(".subcategories").css({
          transform: `translateX(${prevValueXPositive - 80}px)`,
        });
      }
    };

    events = () => {
      $(".subcat-next").on("click", this.arrowNextClick);
      $(".subcat-prev").on("click", this.arrowPrevClick);
    };
  }

  class Contents {
    constructor() {
      this.contentDir =
        "https://s3-ap-southeast-1.amazonaws.com/qcnt-portal/portal";
    }

    fetchContents = (e) => {
      const offset = $(".card-container").length - 1;

      for (let i = 0; i < 10; i++) {
        $(".content-list").append($("#skel-card-loader").contents().clone());
      }

      $.ajax({
        type: "Post",
        url: "init/methods_ajax.php",
        data: `offset=${offset}&category=${$(e.currentTarget).attr(
          "data-catid"
        )}&subcategory=${$(e.currentTarget).attr("data-subid")}`,
        dataType: "json",
        success: (data, textStatus, xhr) => {
          $(".skel-card-container").remove();
          if (xhr.status === 200) {
            $.each(data["contents"], (i, item) => {
              const {
                category,
                subcategory,
                title,
                description,
                icon_file_name,
                content_file_name,
              } = item;

              const folderName = title.replaceAll(" ", "+");
              const iconName = icon_file_name.slice(
                0,
                icon_file_name.length - 4
              );
              const fileName = content_file_name.replaceAll(" ", "+");

              $(".content-list").append(`
                <div class="card-container">
                  <div class="card-upper-part">
                    <img src="${
                      this.contentDir
                    }/${category.toLowerCase()}/${subcategory.toLowerCase()}/${folderName.toLowerCase()}/${iconName}.png" alt="${title}" />
                    <div class="upper-part-details" data-category="${category}" data-subcategory="${subcategory}"></div>
                  </div>
                  <div class="card-middle-part">
                    <h4>${title}</h4>
                    <div>
                      <p>${description}</p>
                    </div>
                  </div>
                  <div class="card-lower-part">
                    <a href="${
                      this.contentDir
                    }/${category.toLowerCase()}/${subcategory.toLowerCase()}/${folderName.toLowerCase()}/${fileName}">DOWNLOAD</a>
                  </div>
                </div>
              `);
            });

            if (data["is_full"]) {
              $(".show-more-btn").remove();
            }
          }
        },
        error: (err) => {
          $(".skel-card-container").remove();
          console.log(err);
        },
      });
    };

    events = () => {
      $(".show-more-btn").on("click", this.fetchContents);
    };
  }

  const navigation = new Navigation();
  const subnavigation = new SubNavigation();
  const contents = new Contents();

  navigation.events();
  subnavigation.events();
  contents.events();
});
