!(function (e) {
  e(document).ready(function () {
    var s,
      a = function (a, t, l) {
        var o = e(".notification-popup ");
        o.find(".task").text(a),
          o.find(".notification-text").text(t),
          o.removeClass("hide success"),
          l && o.addClass(l),
          s && clearTimeout(s),
          (s = setTimeout(function () {
            o.addClass("hide");
          }, 3e3));
      },
      t = function () {
        var s = e("#new-task").val();
        if ("" == s)
          e("#new-task").addClass("error"),
            e(".new-task-wrapper .error-message").removeClass("hidden");
        else {
          var t = e(".todo-list-body").prop("scrollHeight"),
            l = e(o).clone();
          l.find(".task-label").text(s),
            l.addClass("new"),
            l.removeClass("completed"),
            e("#todo-list").append(l),
            e("#new-task").val(""),
            e("#mark-all-finished").removeClass("move-up"),
            e("#mark-all-incomplete").addClass("move-down"),
            a(s, "added to list"),
            e(".todo-list-body").animate({ scrollTop: t }, 1e3);
        }
      },
      l = function () {
        e(".add-task-btn").toggleClass("hide"),
          e(".new-task-wrapper").toggleClass("visible"),
          e("#new-task").hasClass("error") &&
            (e("#new-task").removeClass("error"),
            e(".new-task-wrapper .error-message").addClass("hidden"));
      },
      o = e(e("#task-template").html());
    e(".add-task-btn").click(function () {
      var s = e(".new-task-wrapper").offset().top;
      e(this).toggleClass("hide"),
        e(".new-task-wrapper").toggleClass("visible"),
        e("#new-task").focus(),
        e("body").animate({ scrollTop: s }, 1e3);
    }),
      e("#todo-list").on("click", ".task-action-btn .delete-btn", function () {
        var s = e(this).closest(".task"),
          t = s.find(".task-label").text(),
          taskId = s.find(".task-label").attr("task-id");

        // AJAX request to delete.php
        e.ajax({
          type: "POST",
          url: "/api/delete-task.php",
          data: { taskId: taskId },
          success: function (response) {
            // Handle success response
            s.remove();
            a(t, " has been deleted.");
          },
          error: function (error) {
            // Handle error
            console.error("Error deleting task:", error);
          },
        });
      }),
      e("#todo-list").on(
        "click",
        ".task-action-btn .complete-btn",
        function () {
          var s = e(this).closest(".task"),
            t = s.find(".task-label").text(),
            taskId = s.find(".task-label").attr("task-id"),
            completed = s.toggleClass("completed").hasClass("completed")
              ? 1
              : 0;

          e.ajax({
            type: "POST",
            url: "/api/mark.php",
            data: { taskId: taskId, completed: completed },
            success: function (response) {
              // Handle success response
              if (completed === 1) {
                a(t, "marked as Incomplete.");
              } else {
                a(t, " marked as complete.", "success");
              }
            },
            error: function (error) {
              // Handle error
              console.error("Error updating task completion status:", error);

              // Revert the completed class if the AJAX request fails
              s.toggleClass("completed");
            },
          });
        }
      );

    var t = function () {
      var s = e("#new-task").val();
      if ("" == s) {
        e("#new-task").addClass("error");
        e(".new-task-wrapper .error-message").removeClass("hidden");
      } else {
        var t = e(".todo-list-body").prop("scrollHeight"),
          l = e(o).clone();
        l.find(".task-label").text(s);
        l.addClass("new");
        l.removeClass("completed");

        // AJAX request to new-task.php
        e.ajax({
          type: "POST",
          url: "/api/new-task.php",
          data: { task: s },
          success: function (response) {
            var responseData = JSON.parse(response);

            var task_id = responseData.task_id;
            // Handle success response
            l.find(".task-label").attr("task-id", task_id); // Set task_id as attribute
            l.addClass("new");
            l.removeClass("completed");

            // Handle success response
            e("#todo-list").append(l);
            e("#new-task").val("");
            e("#mark-all-finished").removeClass("move-up");
            e("#mark-all-incomplete").addClass("move-down");
            a(s, "added to list");
            e(".todo-list-body").animate({ scrollTop: t }, 1000);
          },
          error: function (xhr, textStatus, errorThrown) {
            // Handle error
            console.error("Error adding new task:", errorThrown);

            // You can display an error message or take other actions here
            alert("Error adding new task. Please try again.");
          },
        });
      }
    };

    e("#add-task").click(t);
    e("#close-task-panel").click(l),
      e("#mark-all-finished").click(function () {
        // AJAX request to complete-all.php
        e.ajax({
          type: "POST",
          url: "/api/mark-all.php",
          data: { completed: 1 },
          success: function (response) {
            // Handle success response
            e("#todo-list .task").addClass("completed");
            e("#mark-all-incomplete").removeClass("move-down");
            e("#mark-all-finished").addClass("move-up");
            a("All tasks", "marked as complete.", "success");
          },
          error: function (error) {
            // Handle error
            console.error("Error marking all tasks as finished:", error);
          },
        });
      }),
      e("#mark-all-incomplete").click(function () {
        e.ajax({
          type: "POST",
          url: "/api/mark-all.php",
          data: { completed: 0 },
          success: function (response) {
            e("#todo-list .task").removeClass("completed"),
              e(this).addClass("move-down"),
              e("#mark-all-finished").removeClass("move-up"),
              a("All tasks", "marked as Incomplete.");
          },
          error: function (error) {
            console.error("Error marking all tasks as finished:", error);
          },
        });
      });
  });
})(jQuery);
